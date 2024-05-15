<?php

namespace App\Http\Controllers;

use App\Http\Resources\RatingResource;
use App\Models\Rating;
use App\Http\Requests\StoreRatingRequest;
use App\Http\Requests\UpdateRatingRequest;

class RatingController extends Controller
{

    public function index()
    {
        return RatingResource::collection(Rating::all());
    }


    public function store(StoreRatingRequest $request)
    {
        Rating::create([
            'user_id'=>auth()->id(),
            'book_id'=>$request->book_id,
            'rating'=>$request->rating,
            'take_time'=>$request->take_time,
            'type'=>$request->type,
            'comment'=>$request->comment,
        ]);
        return response()->json(['message'=>'Rating created successfully!']);
    }


    public function show(string $id)
    {
        return new RatingResource(Rating::find($id));
    }


    public function update(UpdateRatingRequest $request,string $id)
    {
        $rating = Rating::find($id);
        $rating->user_id = auth()->id();
        $rating->book_id = $request->book_id;
        $rating->rating = $request->rating;
        $rating->take_time = $request->take_time;
        $rating->type = $request->type;
        $rating->comment = $request->comment;
        $rating->save();
        return response()->json(['message' =>'Rating updated successfully!']);
    }

    public function destroy(string $id)
    {
        Rating::destroy($id);
        return response()->json(['message' =>'Rating deleted successfully!']);
    }
}
