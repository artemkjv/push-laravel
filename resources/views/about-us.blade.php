@extends('layouts.app')
@section('content')
    <div class="block my-5">
        <h1 class="block-title text-align-center">About Devonics</h1>
        <p class="block-subtitle text-align-center m-auto">
            We started as app developers who wanted an easy way of messaging our
            users. Finding no good solution, we built Devonics
        </p>
        <p class="light-font mt-5" style="font-size: 20px;">
            Today, we’re a market-leading customer messaging and engagement
            solution, offering mobile and web push notifications, in-app messaging,
            SMS, and email. Our powerful multi-channel platform enables one million
            businesses to deliver over 10 billion messages daily. Powered by
            superior architecture, Devonics is designed to scale with your business
            and deliver messages more quickly and reliably than the competition. By
            providing an open API, extensive documentation, free accounts, and
            intuitive personalization and analytics tools, we help businesses of all
            sizes provide a seamless messaging experience to create meaningful
            customer connections.
        </p>
        <div class="row justify-content-center text-align-lg-center">
            <div class="col-lg-3 col-xxl-2">
                <h1 class="light-font">754,564</h1>
                <p class="aup_header_block_statistics_description">Live apps</p>
            </div>
            <div class="col-lg-3 col-xxl-2">
                <h1 class="light-font">10 Billion+</h1>
                <p class="aup_header_block_statistics_description">
                    Daily messages sent
                </p>
            </div>
            <div class="col-lg-3 col-xxl-2">
                <h1 class="light-font">1,500,000+</h1>
                <p class="aup_header_block_statistics_description">Developers</p>
            </div>
            <div class="col-lg-3 col-xxl-2">
                <h1 class="light-font">3.7%</h1>
                <p class="aup_header_block_statistics_description">Internet sites</p>
            </div>
        </div>
    </div>
    <div class="block my-5">
        <h1 class="medium-font text-align-center">One Team One Dream</h1>
        <div class="row row-cols-5" style="row-gap: 36px;">
            @for($i = 0; $i < 11; $i++)
                <div class="col">
                    <img style="max-width: 200px;" src="{{ asset('assets/images/team-image.svg') }}" class="block-image"
                         alt="Team image">
                </div>
            @endfor
        </div>

        <div class="my-5">
            <h1 class="medium-font text-align-center">Our Investors</h1>
        </div>

        <div class="map m-auto">
            <img src="{{ asset('assets/images/map-image.svg') }}" alt="Map Image" class="block-image"
                 style="visibility: hidden;">
            <p class="display-5">Map</p>
        </div>

    </div>

    <div class="block py-5"
         style="background-image: url('{{ asset('assets/images/start-now-back.svg') }}')">
        <h1 class="semibold-font text-align-center">
            Get Started Today For Free With Our Tool
        </h1>
        <h3 class="light-font text-align-center">
            We’ll get you going in a matter of minutes.
        </h3>
        <div class="d-flex justify-content-center" style="gap: 48px; margin-top: 80px;">
            <a class="btn btn-lg">Get Started Now</a>
            <a class="btn btn-lg btn-yellow">Contact Sales</a>
        </div>

        <div class="contact-us text-turquoise text-align-center" style="padding-top: 80px;">
            Have questions?
            <a href="" class="text-decoration-underline text-turquoise">Chat with an expert.</a>
        </div>
    </div>
@endsection
