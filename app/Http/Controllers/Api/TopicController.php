<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TopicRequest;
use App\Http\Resources\TopicResource;
use App\Models\Topic;
use App\Models\UserTopicPivot;
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
        $data = $request->validated();
        $new_topic = Topic::create([
            'name' => $data['name'],
            'user_id' => Auth::id()
        ]);

        return new TopicResource($new_topic);
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

    public function selectTopic(Topic $topic)
    {
        UserTopicPivot::create([
            'user_id' => Auth::id(),
            'topic_id' => $topic->id
        ]);

        return response()->json(['data' => "Topic $topic->name selected"], 200);
    }

    public function deleteSelectedTopic(Topic $topic)
    {
        UserTopicPivot::create([
            'user_id' => Auth::id(),
            'topic_id' => $topic->id
        ]);

        return response()->json(['data' => "Topic $topic->name selected"], 200);
    }
}
