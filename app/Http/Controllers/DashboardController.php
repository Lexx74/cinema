<?php

namespace App\Http\Controllers;

use App\Genre;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @return Dashboard with options and stats
     */
    public function index()
    {
        $isAdmin = $this->getIsAdmin(Auth::user());
        $registeredUsers = User::all()->count();

        return view('dashboard.index')->with(['isAdmin' => $isAdmin, 'registeredUsers' => $registeredUsers]);
    }

    /**
     * Tells if I'm an Admin
     * @param $currentUser
     * @return true if I'm an admin, false otherwise
     */
    public function getIsAdmin($currentUser)
    {
        $adminUsers = DB::table('users')->where('users.id', '=', $currentUser->id)->join('roles', 'users.role_id', '=', 'roles.id')->where('roles.role_description', '=', 'Admin')->get();

        if(count($adminUsers) > 0)
        {
            // I am an admin
            return true;
        }
        else
        {
            // I'm not
            return false;
        }
    }

    /**
     * @return view to insert a movie in the DB
     */
    public function addMovie()
    {
        $genres = Genre::all();
        return view('dashboard.addmovie')->with('genres', $genres);
    }

    /**
     * Store a movie in the DB
     * @param Request $request the form request
     * @return the dashboard with a message if the movie is successfully saved
     */
    public function storeMovie(Request $request)
    {
        $movie = new Movie();
        $movie->title = $request->input('title');
        $movie->genre_id = $request->input('genre');
        $movie->year = $request->input('year');
        $movie->director = $request->input('director');
        $movie->url_trailer = $request->input('trailer_url');
        $movie->length = $request->input('length');
        $movie->plot = $request->input('plot');
        $movie->country = $request->input('country');
        // TODO
        /*
        if ($request->file('poster')->isValid()) {
            // $request->file('photo')->move($destinationPath, $fileName);
        }*/
        $movie->save();

        \Session::flash('success_flash_message', 'Your movie has been created.');

        return redirect('dashboard');
    }
}
