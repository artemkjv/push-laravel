@extends('layouts.auth')
@section('content')
    <div class="two-factor-page row justify-content-center">
        <form method="post" class="two-factor-form col-md-4" action="{{ route('auth.tfa.login') }}">
            @csrf
            <p class="h5 mb-3 fw-normal text-center">Enter the TFA-Code</p>
            <div class="form-floating mb-3">
                <input type="number" class="input-lg input-rounded @error('auth_code') is-invalid @enderror" id="auth_code" name="auth_code">
            </div>
            @error('auth_code')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
            </span>
            @enderror
            <div class="mt-3">
                <a href="{{ route('welcome') }}" class="btn btn-danger">Go Back</a>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
@endsection
