@extends('layouts.layout')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Settings</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route("home") }}">Home</a></li>
                        <li class="breadcrumb-item active">Settings</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-6 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            Account Details
                        </div>
                        <div class="card-body">
                            <form method="post" action="{{ route('user.changePassword') }}">
                                @method('PUT')
                                @csrf
                                <div>
                                    <label for="password">New Password</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror "
                                           name="password" id="password" placeholder="Password">
                                </div>
                                <div class="form-group mb-4">
                                    <label for="password_confirmation">Confirm Password</label>
                                    <input type="password" class="form-control" name="password_confirmation"
                                           id="password_confirmation" placeholder="Password">
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>

                    <div class="card mt-4">
                        <div class="card-body">
                            <form method="post" action="{{ route('user.regenerateToken') }}">
                                @if(is_null(request()->user()->api_token))
                                    @method('PUT')
                                    @csrf
                                    <button type="submit" class="btn btn-secondary">Generate Api Token</button>
                                    <a href="{{ route('apiToken.index') }}" class="btn btn-success">Temporary Tokens</a>
                                @else
                                    <div class="row justify-content-between">
                                        <div class="col-lg-6">
                                            Api Token: {{ request()->user()->api_token }}
                                        </div>
                                        @method('PUT')
                                        @csrf
                                        <div class="col-lg-auto">
                                            <button type="submit" class="btn btn-secondary">Regenerate</button>
                                            <a href="{{ route('apiToken.index') }}" class="btn btn-success">Temporary
                                                Tokens</a>
                                        </div>
                                    </div>
                                @endif
                            </form>
                        </div>
                    </div>

                    <div class="card mt-4">
                        <div class="card-header">
                            2-Step Authentication
                        </div>
                        <div class="card-body">
                            @if (is_null(request()->user()->two_factor_secret))
                                2-Step Authentication is <b>OFF</b>
                                <a href="{{ route('tfa.index') }}" class="btn btn-secondary float-end">Enable</a>
                            @else
                                2-Step Authentication is <b>ON</b>
                                <form method="post" action="{{ route('tfa.disable') }}">
                                    @method('PUT')
                                    @csrf
                                    <button type="submit" class="btn btn-secondary float-end">Disable</button>
                                </form>
                            @endif
                        </div>
                    </div>
                    <a href="{{ route('moderator.index') }}" class="list-group-item list-group-item-action mt-4">Moderators</a>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

@endsection
