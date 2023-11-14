<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserTopicResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'user_id' => $request->user()->id,
            'topics_amount' => count($request->user()->topics),
            'topics' => [
                TopicResource::collection($request->user()->topics)
            ]
        ];
    }
}
