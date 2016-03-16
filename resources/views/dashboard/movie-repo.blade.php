@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                @include('parts.left_menu_dashboard')
            </div>
            <div class="col-md-9">
                @if(Session::has('success_flash_message'))
                    @include('parts.success_flash')
                @endif

                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h1 class="panel-title">Number of movies by genre</h1>
                        </div>
                        <div class="panel-body">
                            <canvas id="genrePie" width="200" height="200"></canvas>
                            <div id="error_genre"></div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h1 class="panel-title">Number of movies by country</h1>
                        </div>
                        <div class="panel-body">
                            <canvas id="countryPie" width="200" height="200"></canvas>
                            <div id="error_country"></div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h1 class="panel-title">Number of movies by directors</h1>
                        </div>
                        <div class="panel-body">
                            <canvas id="directorPie" width="200" height="200"></canvas>
                            <div id="error_director"></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="application/javascript">
        Chart.defaults.global.responsive = true;

        $.ajax({
            url: 'http://localhost/cinema/public/dashboard/get-genres-pie',
            data: {
                format: 'json'
            },
            error: function() {
                $('#error_genre').html('<p><b>An error has occurred</b></p>');
            },
            success: function(data) {
                /*
                $.each(data, function (index, value)
                {
                    console.log(value);
                });*/

                //console.log(data[0].description);
                // Get the context of the canvas element we want to select
                var ctx = document.getElementById("genrePie").getContext("2d");
                var myNewChart = new Chart(ctx).Pie(data);
            },
            type: 'GET'
        });

        $.ajax({
            url: 'http://localhost/cinema/public/dashboard/get-country-pie',
            data: {
                format: 'json'
            },
            error: function() {
                $('#error_genre').html('<p><b>An error has occurred</b></p>');
            },
            success: function(data) {
                // Get the context of the canvas element we want to select
                var ctx = document.getElementById("countryPie").getContext("2d");
                var myNewChart = new Chart(ctx).Pie(data);
            },
            type: 'GET'
        });

        $.ajax({
            url: 'http://localhost/cinema/public/dashboard/get-director-pie',
            data: {
                format: 'json'
            },
            error: function() {
                $('#error_director').html('<p><b>An error has occurred</b></p>');
            },
            success: function(data) {
                // Get the context of the canvas element we want to select
                var ctx = document.getElementById("directorPie").getContext("2d");
                var myNewChart = new Chart(ctx).Pie(data);
            },
            type: 'GET'
        });
    </script>
@endsection