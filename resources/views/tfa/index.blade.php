@extends('layouts.layout')
@section('content')
    <div class="content-wrapper form-wrapper container content-border">
        <div class="content-body">
            <div class="card">
                <div class="card-header">
                    Step 1: Open an authenticator app on your mobile device and scan this QR code or enter the secret key.
                </div>
                <div class="card-body">
                    {!! $qrImage !!}
                    <span style="vertical-align: middle; margin-left: 40px;">
                            Secret Key: {{ $secretKey }}
                    </span>
                </div>
            </div>
            <div class="card mt-4">
                <div class="card-header">
                    Step 2: Enter the 6-digit code from the authenticator app.
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('tfa.enable') }}">
                        @method('PUT')
                        @csrf
                        <input type="hidden" value="{{ $secretKey }}" name="secret_key">
                        <div class="mb-3">
                            <label for="auth_code" class="form-label">Authentication Code</label>
                            <input type="number" class="form-control@error('auth_code') is-invalid @enderror" id="auth_code" name="auth_code">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
