<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRatingRequest;
use App\Models\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function store(StoreRatingRequest $request)
    {
        $rating = Rating::create([
            'user_id'=>auth()->id(),
            'book_id'=>$request->book_id,
            'rating'=>$request->rating,
            'take_time'=>$request->take_time,
            'type'=>$request->type,
            'comment'=>$request->comment,
        ]);
        if($rating){
            return redirect()->back()->with('success','Your review submitted successfully!');
        }
        return redirect()->back()->with('error','Oops, something went wrong!');

    }
}
