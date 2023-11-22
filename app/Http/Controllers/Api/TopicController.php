<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TopicRequest;
use App\Http\Resources\TopicResource;
use App\Http\Resources\UserTopicResource;
use App\Http\Resources\WordResource;
use App\Models\Topic;
use App\Models\UserTopicPivot;
use App\Models\Word;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class TopicController extends Controller
{
    public function index()
    {
        return TopicResource::collection(Topic::all());
    }

    public function show($id)
    {
        return new TopicResource(Topic::with('wordsets')->find($id));
    }

    public function store(TopicRequest $request)
    {
        return new TopicResource(Topic::create($request->validated()));
    }

    public function update(TopicRequest $request, Topic $topic)
    {
        $topic->update($request->validated());
        return new TopicResource($topic);
    }

    public function destroy(Topic $topic)
    {
        $topic->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function selectTopic(Topic $topic): UserTopicResource
    {
        return new UserTopicResource(UserTopicPivot::create([
            'topic_id' => $topic->id,
            'user_id' => Auth::id()
        ]));
    }

    public function deleteTopic(Topic $topic)
    {
        UserTopicPivot::where('topic_id', $topic->id)
            ->where('user_id', Auth::id())
            ->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function selectedList(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        return UserTopicResource::collection(Auth::user()->topics);
    }

    public function getLearningList()
    {
        $words = Word::whereHas('wordset', function ($query) {
            $query->whereHas('topic', function ($query) {
                $query->whereHas('users', function ($query){
                   $query->where('id', Auth::id());
                });
            });
        })->get();

        return WordResource::collection($words);
    }
}
