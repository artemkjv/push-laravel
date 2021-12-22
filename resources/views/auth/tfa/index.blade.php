@extends('layouts.app')
@section('content')
    @include('components.messages')
    <div class="two-factor-page">
        <form method="post" class="two-factor-form" action="{{ route('auth.tfa.login') }}">
            @csrf
            <p class="h5 mb-3 fw-normal text-center">Enter the TFA-Code</p>
            <div class="form-floating mb-3">
                <input type="number" class="form-control @error('auth_code') is-invalid @enderror" id="auth_code" name="auth_code">
                <label for="auth_code">Authentication Code</label>
            </div>
            <a href="{{ route('welcome') }}" class="btn btn-danger">Go Back</a>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
