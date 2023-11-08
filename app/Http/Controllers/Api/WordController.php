<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\WordRequest;
use App\Http\Resources\WordResource;
use App\Models\Word;
use Symfony\Component\HttpFoundation\Response;


class WordController extends Controller
{
    public function index() {
        return WordResource::collection(Word::all());
    }

    public function show($id){
        return new WordResource(Word::find($id));
    }

    public function store (WordRequest $request) {
        return new WordResource(Word::create($request->validated()));
    }

    public function update(WordRequest $request, Word $word) {
        $word->update($request->validated());
        return new WordResource($word);
    }

    public function destroy(Word $word) {
        $word->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function markAsLearned(){



    }
}
