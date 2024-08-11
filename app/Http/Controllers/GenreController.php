<?php

namespace App\Http\Controllers;

use App\Http\Resources\GenreResource;
use App\Models\Genre;
use App\Http\Requests\StoreGenreRequest;
use App\Http\Requests\UpdateGenreRequest;

class GenreController extends Controller
{

    public function index()
    {
        return GenreResource::collection(Genre::all())->all();
    }

    public function store(StoreGenreRequest $request)
    {
        Genre::create($request->all());
        return response()->json(['message'=>'Genre created successfully!']);
    }

    public function show($id)
    {
        return new GenreResource(Genre::find($id));
    }

    public function update(UpdateGenreRequest $request, string $id)
    {
        $genre = Genre::find($id);
        $genre->update($request->all());
//        $genre->save();
        return response()->json(['message'=>'Genre updated successfully!']);
    }

    public function destroy(string $id)
    {
        Genre::destroy($id);
        return response()->json(['message'=>'Genre deleted successfully!']);
    }
}
