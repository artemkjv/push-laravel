@extends('layouts.layout')
@section('content')
    @include('moderator.components.topbar')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit {{ $moderator->email }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route("home") }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('user.index') }}">Settings</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('moderator.index') }}">Moderators</a></li>
                        <li class="breadcrumb-item active">Edit Moderator</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <form role="form" method="post" action="{{ route('moderator.update', ['id' => $moderator->id]) }}">
                <div class="row">
                    <div class="col-xl-6 col-sm-12">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                   name="name" value="{{ old('name', $moderator->name) }}" required>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-xl-6 col-sm-12">
                        <div class="form-group">
                            <label for="apps">Applications</label>
                            <select id="apps" name="apps[]" class="tokenize2" multiple aria-label="Apps">
                                @foreach($apps as $app)
                                    <option @if($chosenApps->contains('id', $app->id)) selected @endif value="{{ $app->id }}">{{ $app->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        {{--<div class="form-group">
                            <label for="segments">Segments</label>
                            <select name="segments[]" id="segments" class="tokenize2" multiple aria-label="Segments">
                                @foreach($segments as $segment)
                                    <option @if($chosenSegments->contains('id', $segment->id)) selected @endif value="{{ $segment->id }}">{{ $segment->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="templates">Templates</label>
                            <select name="templates[]" id="templates" class="tokenize2" multiple aria-label="Templates">
                                @foreach($templates as $template)
                                    <option @if($chosenTemplates->contains('id', $template->id)) selected @endif value="{{ $template->id }}">{{ $template->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="customPushes">Custom Pushes</label>
                            <select name="customPushes[]" class="tokenize2" id="customPushes" multiple aria-label="Custom Pushes">
                                @foreach($customPushes as $customPush)
                                    <option @if($chosenCustomPushes->contains('id', $customPush->id)) selected @endif value="{{ $customPush->id }}">{{ $customPush->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="autoPushes">Auto Pushes</label>
                            <select name="autoPushes[]" class="tokenize2" id="autoPushes" multiple aria-label="Auto Pushes">
                                @foreach($autoPushes as $autoPush)
                                    <option @if($chosenAutoPushes->contains('id', $autoPush->id)) selected @endif value="{{ $autoPush->id }}">{{ $autoPush->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="weeklyPushes">Weekly Pushes</label>
                            <select name="weeklyPushes[]" class="tokenize2" id="weeklyPushes" multiple aria-label="Weekly Pushes">
                                @foreach($weeklyPushes as $weeklyPush)
                                    <option @if($chosenWeeklyPushes->contains('id', $weeklyPush->id)) selected @endif value="{{ $weeklyPush->id }}">{{ $weeklyPush->name }}</option>
                                @endforeach
                            </select>
                        </div>--}}
                    </div>
                    <!-- /.col -->
                    <div class="col-1">
                        <button type="submit" class="btn btn-primary mt-1">Submit</button>
                    </div>

                </div>
                <!-- /.row -->
            </form>
        </div><!-- /.container-fluid -->
    </section>
@endsection

@section('scripts')
    <script>
        let entities = $('.tokenize2')
        entities.tokenize2({
            dataSource: 'select',
        })
    </script>
@endsection
