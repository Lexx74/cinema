<?php

namespace App\Http\Controllers;


use App\Genre;
use App\Http\Requests;
use App\Movie;
use App\Show;
use Illuminate\Http\Request;

class MoviesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['only' => ['insert']]);
    }

    /**
     * @return index view with all movies ordered by year desc
     */
    public function index()
    {
        $movies = Movie::orderBy('year', 'desc')->get();
        return view('movies.index')->with('movies', $movies);
    }

    /**
     * @param $id of the movie
     * @return the view that show the details of a movie
     */
    public function details($id)
    {
        $movie = Movie::findOrFail($id);
        $genre = Genre::findOrFail($movie->genre_id);
        $shows = Show::where('id_movie', '=', $movie->id)->get();
        return view('movies.details')->with(['movie' => $movie, 'genre' => $genre, 'shows' => $shows]);
    }

}
