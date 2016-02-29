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
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h1 class="panel-title">Dashboard</h1>
                    </div>
                    <div class="panel-body">
                        <p>From here you can access to every page of your dashboard :)</p>
                    </div>
                </div>
                @if ($isAdmin)
                    @include('parts.customer_repo')
                @endif
            </div>
        </div>
    </div>
@endsection