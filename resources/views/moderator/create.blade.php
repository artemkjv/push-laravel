@extends('layouts.layout')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create Moderator</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route("home") }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('user.index') }}">Settings</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('moderator.index') }}">Moderators</a></li>
                        <li class="breadcrumb-item active">Create Moderator</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <form role="form" method="post" action="{{ route('moderator.store') }}">
                <div class="row">
                    <div class="col-xl-6 col-sm-12">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                   name="name" value="{{ old('name') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="email">E-Mail Address</label>
                            <input type="email" name="email"
                                   required
                                   class="form-control @error('email') is-invalid @enderror" id="email"
                                   value="{{ old('email') }}"
                            >
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input id="password" type="password"
                                   class="form-control @error('password') is-invalid @enderror" name="password"
                                   required>
                        </div>
                        <div class="form-group">
                            <label for="password-confirm">Confirm Password</label>
                            <input id="password-confirm" type="password" class="form-control"
                                   name="password_confirmation" required>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-xl-6 col-sm-12">
                        <div class="form-group">
                            <label for="apps">Applications</label>
                            <select id="apps" name="apps[]" class="tokenize2" multiple aria-label="Apps">
                                @foreach($apps as $app)
                                    <option value="{{ $app->id }}">{{ $app->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="segments">Segments</label>
                            <select name="segments[]" id="segments" class="tokenize2" multiple aria-label="Segments">
                                @foreach($segments as $segment)
                                    <option value="{{ $segment->id }}">{{ $segment->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="templates">Templates</label>
                            <select name="templates[]" id="templates" class="tokenize2" multiple aria-label="Templates">
                                @foreach($templates as $template)
                                    <option value="{{ $template->id }}">{{ $template->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="customPushes">Custom Pushes</label>
                            <select name="customPushes[]" class="tokenize2" id="customPushes" multiple aria-label="Custom Pushes">
                                @foreach($customPushes as $customPush)
                                    <option value="{{ $customPush->id }}">{{ $customPush->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="autoPushes">Auto Pushes</label>
                            <select name="autoPushes[]" class="tokenize2" id="autoPushes" multiple aria-label="Auto Pushes">
                                @foreach($autoPushes as $autoPush)
                                    <option value="{{ $autoPush->id }}">{{ $autoPush->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="weeklyPushes">Weekly Pushes</label>
                            <select name="weeklyPushes[]" class="tokenize2" id="weeklyPushes" multiple aria-label="Weekly Pushes">
                                @foreach($weeklyPushes as $weeklyPush)
                                    <option value="{{ $weeklyPush->id }}">{{ $weeklyPush->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
                <button type="submit" class="btn btn-primary mt-1 float-end">Submit</button>
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
