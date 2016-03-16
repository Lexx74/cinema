<?php

namespace App\Http\Controllers;

use App\Genre;
use App\Movie;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\File\UploadedFile;

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

        // Save isAdmin in a session so i don't have to pass it to every page
        // Do I have to put it in the constructor?
        Session::put('isAdmin', $isAdmin);

        $registeredUsers = User::all()->count();
        return view('dashboard.index')->with('registeredUsers', $registeredUsers);
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
        $movie->yt_video_id = $request->input('yt_video_id');
        $movie->length = $request->input('length');
        $movie->plot = $request->input('plot');
        $movie->country = $request->input('country');

        if ($request->file('poster')->isValid()) {
            // check if it is an image
            $this->validate($request, [
                'poster' => 'image',
            ]);

            // get the right file extension
            $fileExtension = $request->file('poster')->getClientOriginalExtension();

            // then I can rename the file
            $fileName = 'poster_' . $request->input('title') . '_' . $request->input('year') . '.' . $fileExtension;

            // moving the image in public/movie_poster
            $folder = '/movie_poster/';
            // move (destination, new_filename);
            $request->file('poster')->move(base_path() . '/public/' . $folder, $fileName);

            // saving in the db where the file is
            $movie->uri_poster = $folder . $fileName;
        }

        // save data on db
        $movie->save();

        \Session::flash('success_flash_message', 'Your movie has been created.');

        return redirect('dashboard');
    }

    /**
     * Shows the view where you can choose what movie delete
     * @return $this
     */
    public function deleteMoviePage()
    {
        $movies = Movie::all();
        $disable = '';

        if ($movies->isEmpty())
        {
            // I have to disable the button Delete
            $disable = 'disabled';
        }
        return view('dashboard.delete-movie')->with(['movies' => $movies, 'disable' => $disable]);
    }

    /**
     * Delete the selected movie from the db
     * @param Request $request
     * @return view
     */
    public function deleteMovie(Request $request)
    {
        Movie::findOrFail($request->input('movies'))->delete();
        \Session::flash('success_flash_message', 'The selected movie has been deleted.');

        $movies = Movie::all();
        return view('dashboard.delete-movie')->with('movies', $movies);
    }

    /**
     * @return The page with the reports
     */
    public function movieReports()
    {
        return view('dashboard.movie-repo');
    }

    /**
     * @return Data for creating the pie of movies by genre
     */
    public function getGenresPie()
    {
        $moviesAndGenres = Movie::join('genres', 'genres.id', '=', 'genre_id')
            ->select(DB::raw('description, count(*) as value'))
            ->groupBy('description')
            ->get();

        foreach($moviesAndGenres as $data)
        {
            switch($data->description)
            {
                case 'Action':
                    $data['label'] = 'Action';
                    $data['color'] = "#878BB6";
                    break;
                case 'Drama':
                    $data['label'] = 'Drama';
                    $data['color'] = "#4ACAB4";
                    break;
                case 'Animation':
                    $data['label'] = 'Animation';
                    $data['color'] = "#FF8153";
                    break;
                case 'Sci-Fi':
                    $data['label'] = 'Sci-Fi';
                    $data['color'] = "#FFEA88";
                    break;
                default:
                    $data['label'] = 'Unknown';
                    break;
            }
        }
        return $moviesAndGenres;
    }

    /**
     * @return data for create the pie of movies by country
     */
    public function getMoviesPerCountryPie()
    {
        $moviesAndCountries = Movie::select(DB::raw('country, count(*) as value'))->groupBy('country')->get();

        foreach($moviesAndCountries as $data)
        {
            switch($data->country)
            {
                case 'UK':
                    $data['label'] = 'UK';
                    $data['color'] = "#878BB6";
                    break;
                case 'Italy':
                    $data['label'] = 'Italy';
                    $data['color'] = "#4ACAB4";
                    break;
                case 'USA':
                    $data['label'] = 'USA';
                    $data['color'] = "#FF8153";
                    break;
                case 'France':
                    $data['label'] = 'France';
                    $data['color'] = "#FFEA88";
                    break;
                default:
                    $data['label'] = 'Unknown';
                    break;
            }
        }
        return $moviesAndCountries;
    }

    /**
     * @return data for creating the director pie
     */
    public function getMoviesPerDirectorPie()
    {
        $moviesAndDirectors = Movie::select(DB::raw('director, count(*) as value'))->groupBy('director')->get();

        foreach($moviesAndDirectors as $data)
        {
            // set the label as the name of the director
            $data['label'] = $data->director;
        }
        return $moviesAndDirectors;
    }
}
