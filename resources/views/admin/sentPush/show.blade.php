@extends('admin.layouts.layout')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Sent Push</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route("admin.user.index") }}">Users</a></li>
                        <li class="breadcrumb-item"><a href="{{ route("admin.user.show", ['id' => $user->id]) }}">User</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.sentPush.index', ['userId' => $user->id]) }}">Sent Pushes</a></li>
                        <li class="breadcrumb-item active">Sent Push</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="audience-tab" data-bs-toggle="tab" data-bs-target="#audience" type="button" role="tab" aria-controls="audience" aria-selected="true">Audience</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="schedule-tab" data-bs-toggle="tab" data-bs-target="#schedule" type="button" role="tab" aria-controls="schedule" aria-selected="false">Schedule</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="content-tab" data-bs-toggle="tab" data-bs-target="#content" type="button" role="tab" aria-controls="content" aria-selected="false">Content</button>
                        </li>
                    </ul>
                    <div class="tab-content mt-2">
                        <div class="tab-pane fade show active" id="audience" role="tabpanel" aria-labelledby="audience-tab">
                            <p>Total number of recipients: {{ $sentPush->sent }}</p>
                            <p>Total number of clicks: {{ $sentPush->clicked }}</p>
                        </div>
                        <div class="tab-pane fade" id="schedule" role="tabpanel" aria-labelledby="schedule-tab">
                            <p>Sent At: {{ $sentPush->created_at }}</p>
                        </div>
                        <div class="tab-pane fade" id="content" role="tabpanel" aria-labelledby="content-tab">
                            <p>Title: {{ $sentPush->title['1'] }}</p>
                            <p>Body: {{ $sentPush->body['1'] }}</p>
                            @if($sentPush->image)
                                <img class="img-thumbnail rounded mt-2" src="{{ asset("/storage/$sentPush->image") }}" alt="Sent Push Image">
                            @endif
                            @if($sentPush->icon)
                                <img class="img-thumbnail rounded mt-2" src="{{ asset("/storage/$sentPush->icon") }}" alt="Sent Push Icon">
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

@endsection
