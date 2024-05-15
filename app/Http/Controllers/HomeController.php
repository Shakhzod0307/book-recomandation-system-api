<?php

namespace App\Http\Controllers;

use App\Http\Resources\BookResource;
use App\Http\Resources\MostRatedReadersResource;
use App\Http\Resources\MostRatingResource;
use App\Http\Resources\RatingResource;
use App\Models\Book;
use App\Models\Genre;
use App\Models\Rating;
use App\Models\User;
use App\Models\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Symfony\Component\DomCrawler\Crawler;

class HomeController extends Controller
{
    public function getCounts()
    {
        $users = User::count();
        $genres = Genre::count();
        $views = View::count();
        return response()->json([
            'users'=>$users,
            'genres'=>$genres,
            'views'=>$views,
        ],201);
    }

    public function mostRated()
    {
        $books = Rating::with('book')->where('rating', '>=', 3)->get();
        return MostRatingResource::collection($books);
    }

    public function mostRatedReaders()
    {
        $ratings = Rating::where('rating', '>=', 3)->get();
        return MostRatedReadersResource::collection($ratings);
    }

}
