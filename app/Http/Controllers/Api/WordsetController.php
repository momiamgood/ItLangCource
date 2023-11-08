<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\WordsetRequest;
use App\Http\Resources\WordsetResource;
use App\Models\Wordset;
use Symfony\Component\HttpFoundation\Response;

class WordsetController extends Controller
{
    public function index() {
        return WordsetResource::collection(Wordset::all());
    }

    public function show($id){
        return new WordsetResource(Wordset::with('words')->find($id));
    }

    public function store(WordsetRequest $request)
    {
        return new WordsetResource(Wordset::create($request->validated()));
    }

    public function update(WordsetRequest $request, Wordset $wordset) {
        $wordset->update($request->validated());
        return new WordsetResource($wordset);
    }

    public function destroy(Wordset $wordset) {
        $wordset->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
