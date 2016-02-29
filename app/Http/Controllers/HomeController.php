<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Movie;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    /**
     * Show the index page with the lastest movies carousel.
     *
     * @return Welcome view
     */
    public function index()
    {
        $lastestMovies = Movie::orderBy('created_at', 'desc')->take(3)->get();
        // the first item of the carousel has to be class="item active"
        $first = true;
        return view('welcome')->with(['last' => $lastestMovies, 'first' => $first]);
    }
}
