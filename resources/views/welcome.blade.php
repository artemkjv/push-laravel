@extends('layouts.app')
@section('content')
    <div class="p-5 mb-4 bg-light rounded-3">
        <div class="container-fluid py-5">
            <h1 class="display-5 fw-bold">Devonics.Push</h1>
            <p class="col-md-8 fs-4">The market leading self-serve customer engagement solution for Push Notifications, Email, SMS &amp; In-App.</p>
            @if(auth()->check())
                <a class="btn btn-primary btn-lg" href="/home">Cabinet</a>
            @else
                <a class="btn btn-primary btn-lg" href="/home">Get Started Now</a>
            @endif
        </div>
    </div>
@endsection
