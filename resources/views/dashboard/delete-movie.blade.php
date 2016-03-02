@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                @include('parts.left_menu_dashboard')
            </div>
            <div class="col-md-8">
                @if(Session::has('success_flash_message'))
                    @include('parts.success_flash')
                @endif
                <h1 class="text-center">Delete a movie</h1>
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="post" action="{{ url('/dashboard/delete-movie') }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <label for="movies">Select a movie:</label>
                        <select class="form-control" name="movies">
                            @foreach($movies as $movie)
                                <option value="{{ $movie->id }}">{{ $movie->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-danger {{ $disable }}"><span class="glyphicon glyphicon-trash"></span> Delete</button>
                </form>

            </div>
        </div>
    </div>
@endsection