<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TopicRequest;
use App\Http\Resources\TopicResource;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $new_topic = Topic::create($request->validated([
            'name' => $request->name,
            'user_id' => Auth::id()
        ]));

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

        return response(null, \Illuminate\Http\Response::HTTP_NO_CONTENT);
    }
}
