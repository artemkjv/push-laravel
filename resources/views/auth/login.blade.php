@extends('layouts.auth')

@section('head')
{!! RecaptchaV3::initJs() !!}
@endsection


@section('content')

<div class="container">

    <div class="row">
        <div class="col-xl-4"></div>
        <div class="col-xl-4">
            <h1 class="display-3 text-align-center">Welcome</h1>
            <form method="post">
                @csrf
                {!! RecaptchaV3::field('login') !!}

                <div class="form-control form-control-lg">
                    <label for="email">Email Address</label>
                    <input id="email" name="email" type="email" class="input-lg input-rounded" value="{{ old('email') }}" required autocomplete="email" />
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-control form-control-lg">
                    <label for="password">Password</label>
                    <input id="password" name="password" type="password" class="input-lg input-rounded" required autocomplete="current-password" />
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-control form-control-lg">
                    <input class="form-check-input form-check-input-lg" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} />
                    <label class="form-check-label-lg" for="remember">Stay logged in?</label>
                </div>
                <button type="submit" class="btn btn-lg btn-auth btn-block max-width-100">Log in</button>
            </form>
        </div>
        <div class="col-xl-4"></div>


    </div>

</div>



@endsection