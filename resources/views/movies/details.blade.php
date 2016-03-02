@extends('layouts.app')

@section('content')
    <!-- Trailer Modal -->
    <div class="modal fade" id="trailerModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <!--<h4 class="modal-title" id="myModalLabel">{{ $movie->title }} Trailer</h4>-->
                </div>
                <div class="modal-body">
                    <!-- 16:9 aspect ratio -->
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/{{ $movie->yt_video_id }}" allowfullscreen></iframe>
                    </div>
                </div>
                <!--<div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>-->
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <img src="{{ url('/') . $movie->uri_poster }}" class="img-responsive">
                <br>
                <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#trailerModal">Trailer</button>
            </div>
            <div class="col-md-9">
                <p><strong>Title:</strong> {{ $movie->title }}</p>
                <p><strong>Genre:</strong> {{ $genre->description }}</p>
                <p><strong>Length:</strong> {{ $movie->length }}</p>
                <p><strong>Year:</strong> {{ $movie->year }}</p>
                <p><strong>Country:</strong> {{ $movie->country }}</p>
                <p><strong>Director:</strong> {{ $movie->director }}</p>
                <p><strong>Plot:</strong> {{ $movie->plot }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <h1 class="text-center">Shows</h1>
                <table class="table table-responsive">
                    <tr>
                        <th>Room</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Tickets</th>
                    </tr>
                    @foreach($shows as $show)
                        <tr>
                            <td>{{ $show->id_room }}</td>
                            <td>{{ \Carbon\Carbon::parse($show->date_time)->format('d/m/Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($show->date_time)->format('h:m') }}</td>
                            <td><button type="button" class="btn btn-primary">Buy Tickets</button></td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <!--This script stops the video when user closes the modal-->
    <script type="text/javascript">
        $(document).ready(function(){
            $('#trailerModal').on('hidden.bs.modal', function () {
                var $this = $(this).find('iframe'),
                        tempSrc = $this.attr('src');
                $this.attr('src', "");
                $this.attr('src', tempSrc);
            });
        });
    </script>
@endsection