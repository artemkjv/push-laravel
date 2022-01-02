@extends('layouts.layout')
@section('content')
    <div class="container content-wrapper form-wrapper content-border">
        <div class="content-header">
        </div>
        <div class="content-body">
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
                            <input type="password" class="form-control @error('password') is-invalid @enderror " name="password" id="password" placeholder="Password">
                        </div>
                        <div class="form-group mb-4">
                            <label for="password_confirmation">Confirm Password</label>
                            <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Password">
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
                    @else
                        Api Token: {{ request()->user()->api_token }}
                        @method('PUT')
                        @csrf
                        <button type="submit" class="btn btn-secondary float-end">Regenerate</button>
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
            @if(request()->user()->role === config('roles.user'))
            <a href="{{ route('moderator.index') }}" class="list-group-item list-group-item-action mt-4">Moderators</a>
            @endif
        </div>
        <div class="content-footer">

        </div>
    </div>
@endsection
