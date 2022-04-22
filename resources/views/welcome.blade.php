@extends('layouts.app')
@section('app-config')
    style="background-repeat: no-repeat; background-image: url('{{ asset('assets/images/header_background.svg') }}'); background-size: cover; background-attachment: fixed;"
@endsection
@section('content')
    <div class="block" style="background-color: transparent;">
        <div class="row">
            <div class="col-xl-6">
                <h1 class="display-2 mb-0 block-title">Customer Messaging Delivered</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-6">
                <p class="block-subtitle mt-xl-5 pb-xl-5">
                    The market leading self-serve customer engagement solution for Push
                    Notifications, Email, SMS &amp; In-App.
                </p>
                <div class="d-flex" style="gap: 48px;">
                    <a class="btn btn-lg">Get Started Now</a>
                    <a class="btn btn-lg btn-yellow">Contact Sales</a>
                </div>
            </div>
            <div class="col-xl-6">
                <img class="block-image" src="{{ asset('assets/images/header_picture.svg') }}" alt="">
            </div>
        </div>
    </div>
@endsection
