<?php

namespace App\Http\Controllers;

use App\Models\Genre;
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


}
