<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserWordResource extends JsonResource
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
            'words_amount' => count($request->user()->words),
            'words' => [
                WordResource::collection($request->user()->words)
            ]
        ];
    }
}
