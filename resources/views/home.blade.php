@extends('layouts.app')

@section('sidenav')
@parent
<div class="grid-item col-2 my-4">
        <div class="card">
            @if(\App\Event::activeEventExists())
            <div class="card-body">
                <button class="btn btn-primary" title="Resume Check-in">{{ \App\Event::active()->name }}</button>
            </div>
            <div class="card-body">
                <a class="card-link" href="#" data-toggle="modal" data-target="#endCheckInModal">End Check-In</a>
            </div>
            @else
            <div class="card-body">
                <a class="card-link" href="#" data-toggle="modal" data-target="#startCheckInModal">Start New Check-In</a>
            </div>
            @endif
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Vineyard Kids: </li>
                <li class="list-group-item">Vineyard Tykes: </li>
            </ul>
        </div>
    </div>
@endsection
@section('content')
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
@endsection
