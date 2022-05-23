@extends('layouts.auth')

@section('head')
{!! RecaptchaV3::initJs() !!}
@endsection

@section('content')

<div class="container">
    <div class="row">
        <div class="col-xl-4"></div>
        <div class="col-xl-4">
            <h1 class="display-4 text-align-center">Create account</h1>
            <form method="post">
                @csrf
                {!! RecaptchaV3::field('register') !!}

                <div class="form-control form-control-lg">
                    <label for="name">Company or organisation name</label>
                    <input class="input-lg input-rounded" name="name" type="text" required value="{{ old('name') }}" />
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-control form-control-lg">
                    <label for="email">Email Address</label>
                    <input class="input-lg input-rounded" name="email" type="email" required value="{{ old('email') }}" />
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-control form-control-lg">
                    <label for="password">Password</label>
                    <input class="input-lg input-rounded" name="password" type="password" />
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-control form-control-lg">
                    <label for="password-confirm">Confirm Password</label>
                    <input class="input-lg input-rounded" name="password_confirmation" type="password" />
                </div>


                <button class="btn btn-lg btn-auth btn-block">Sign up</button>
            </form>
        </div>
        <div class="col-xl-4"></div>

    </div>
</div>

@endsection