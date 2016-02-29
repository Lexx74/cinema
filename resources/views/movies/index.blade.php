@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @foreach($movies as $movie)
                <div class="col-md-3">
                    <a href="{{ url('/movies', $movie->id) }}" class="thumbnail" id="{{ $movie->id }}">
                        <img class="img-responsive center-block" src="http://placehold.it/300x300" alt="poster-img">
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection