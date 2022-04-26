@extends('layouts.app')
@section('app-config')
    style="background-repeat: no-repeat; background-size: cover; background-image: url('{{ asset('assets/images/header_background.svg') }}'); background-attachment: fixed; padding-bottom: 0;"
@endsection
@section('content')
    <div class="block pt-5 pb-5" style="background-color: transparent;">
        <div class="row">
            <div class="col-xl-7">
                <h1 class="mb-0 block-title">Customer Messaging Delivered</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-7">
                <p class="block-subtitle mt-xl-5 pb-xl-5">
                    The market leading self-serve customer engagement solution for Push
                    Notifications, Email, SMS &amp; In-App.
                </p>
                <div class="d-flex justify-content-center justify-content-sm-start mt-4 mt-sm-0" style="gap: 48px;">
                    <a class="btn btn-lg">Get Started Now</a>
                    <a class="btn btn-lg btn-yellow">Contact Sales</a>
                </div>
            </div>
            <div class="col-xl-5 mt-xl-5 mt-xl-0">
                <img class="d-none d-xl-block block-image" src="{{ asset('assets/images/header_picture.svg') }}" alt="">
            </div>
        </div>
    </div>
    <div class="block pt-5 pb-5" style="background-image: url('{{ asset("assets/images/description_background.svg") }}');">
        <h1 class="semibold-font text-align-center">Everything You’re Looking For in One Tool</h1>
        <h3 class="text-align-center light-font mb-5 mb-xl-6">It’s never been easier to connect with customers.</h3>
        <div class="row justify-content-center justify-content-md-evenly gap-2 gap-md-0">
            <div class="row col-12 col-sm-12 col-md-6 col-lg-12 gap-2 gap-lg-0">
                <div class="col-12 col-lg-4">
                    <div class="description-card">
                        <div class="description-card-head">
                            Mobile Push Notifications
                        </div>
                        <div class="description-card-body">
                            Be the first message customers see when they pick up their phones.
                            Notifications are the primary traffic source for most mobile apps.
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="description-card">
                        <div class="description-card-head">
                            Web Push Notifications
                        </div>
                        <div class="description-card-body">
                            Stay in front of your customers even after they leave your site.
                            Works on Chrome, Safari, Firefox, Edge, Opera, and Yandex.
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="description-card">
                        <div class="description-card-head">
                            Email
                        </div>
                        <div class="description-card-body">
                            Design emails that look great on every device with the drag-and
                            drop composer. Customize our free templates to match your brand.
                        </div>
                    </div>
                </div>
            </div>
                <div class="row mt-lg-5 ms-lg-5 col-12 col-sm-12 col-md-6 col-lg-12 gap-2 gap-lg-0">
                <div class="col-12 col-lg-4">
                    <div class="description-card">
                        <div class="description-card-head">
                            SMS
                        </div>
                        <div class="description-card-body">
                            Reach customers directly on their phone for higher engagement.
                            Communicate with customers who don’t have your app or a
                            smartphone.
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="description-card">
                        <div class="description-card-head">
                            Journeys
                        </div>
                        <div class="description-card-body">
                            Seamlessly manage your messaging across channels with our
                            easy-to-use messaging workflow builder, all with no code required.
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="description-card">
                        <div class="description-card-head">
                            In-App Messages
                        </div>
                        <div class="description-card-body">
                            Deliver messages that create delight. Design banners, pop-ups, and
                            interstitials; implement without a single line of code.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="block pt-5 pb-5">
        <h1 class="semibold-font text-align-center mt-0">
            Key to Success for Marketers
        </h1>
        <h3 class="text-align-center light-font mb-xl-6">
            Connect with your audience the right way
        </h3>
        <div class="row">
            <div class="col-xl-3">
                <div class="advantage-card">
                    <div class="advantage-card-head">15 Minute Setup</div>
                    <div class="advantage-card-body">
                        Our users are always shocked at how easy it is to get started.
                    </div>
                </div>
            </div>
            <div class="col-xl-3">
                <div class="advantage-card">
                    <div class="advantage-card-head">Real-Time Reporting</div>
                    <div class="advantage-card-body">
                        View delivery and conversion performance for every message.
                    </div>
                </div>
            </div>
            <div class="col-xl-3">
                <div class="advantage-card">
                    <div class="advantage-card-head">Incredible Scalability</div>
                    <div class="advantage-card-body">
                        Millions of users? No problem. We send out billions of notifications
                        daily.
                    </div>
                </div>
            </div>
            <div class="col-xl-3">
                <div class="advantage-card">
                    <div class="advantage-card-head">A/B Testing</div>
                    <div class="advantage-card-body">
                        Compare message performance and automatically send the best.
                    </div>
                </div>
            </div>
        </div>

        <div class="row pt-xl-5">
            <div class="col-xl-3">
                <div class="advantage-card">
                    <div class="advantage-card-head">Superior Segmentation</div>
                    <div class="advantage-card-body">
                        Create personalized messages and send them to the right audiences.
                    </div>
                </div>
            </div>
            <div class="col-xl-3">
                <div class="advantage-card">
                    <div class="advantage-card-head">Automated Messaging</div>
                    <div class="advantage-card-body">
                        Set it and forget it. You can trigger notifications based on user
                        behavior.
                    </div>
                </div>
            </div>
            <div class="col-xl-3">
                <div class="advantage-card">
                    <div class="advantage-card-head">Intelligent Delivery</div>
                    <div class="advantage-card-body">
                        Leverage machine learning to send your messages at the optimal time.
                    </div>
                </div>
            </div>
            <div class="col-xl-3">
                <div class="advantage-card">
                    <div class="advantage-card-head">Analyze Results Anywhere</div>
                    <div class="advantage-card-body">
                        Our SDKs are open source and every component is accessible via API.
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="block pt-5 pb-5"
         style="background-image: url('{{ asset('assets/images/developer-bg.svg') }}');">
        <div class="row">
            <div class="col-xl-4">
                <h1 class="semibold-font mt-0">
                    Loved by Developers
                </h1>
                <h3 class="light-font mb-xl-6">
                    Our founders were developers who built OneSignal out of a personal
                    need. We've made it easy for any business to get running and to
                    get amazing results. All in less than 10 lines of code.
                </h3>
                <div class="integrations-list">
                    <a href="#" class="btn btn-yellow-outline input-rounded text-align-start">Apple iOS</a>
                    <a href="#" class="btn btn-yellow-outline input-rounded text-align-start">Android</a>
                    <a href="#" class="btn btn-yellow-outline input-rounded text-align-start">Web Push</a>
                    <a href="#" class="btn btn-yellow-outline input-rounded text-align-start">React Native</a>
                    <a href="#" class="btn btn-yellow-outline input-rounded text-align-start">Unity</a>
                    <a href="#" class="btn btn-yellow-outline input-rounded text-align-start">Flutter</a>
                </div>
                <div class="links-list">
                    <a href="#" class="link">Read The Getting Started Docs
                        <img src="{{ asset('assets/images/for_developers_link_arrow.svg') }}" alt="">
                    </a>
                    <a href="#" class="link">Get Your Free API Key
                        <img src="{{ asset('assets/images/for_developers_link_arrow.svg') }}" alt="">
                    </a>
                </div>
            </div>
            <div class="col-xl-8">
                <div class="developer-image">
                    <img class="block-image" style="max-width: 755px;" src="{{ asset('assets/images/developer-image.svg') }}" alt="Developer Image">
                </div>
            </div>
        </div>
        <div class="block-footer">
            <p class="footer-description">
                Code in any language. We provide native support for every
                development environment.
            </p>
            <p class="footer-description">30+ Platform Integrations</p>
        </div>
    </div>
    <div class="block pt-5 pb-5">
        <div class="container">
            <div class="row">
                <div class="col-xl-6">
                    <img class="block-image max-xl-380" src="{{ asset('assets/images/gradient-block.svg') }}" alt="Gradient">
                </div>
                <div class="col-xl-6">
                    <h1 class="semibold-font mt-0">
                        Limitless Integrations
                    </h1>
                    <h3 class="light-font">
                        OneSignal integrates with leading analytics, CMS, and eCommerce
                        solutions including Amplitude, Mixpanel, Segment, HubSpot, Shopify,
                        WordPress, and many more.
                    </h3>
                    <h3 class="light-font">
                        Sync audiences and user data to trigger real-time messages.
                    </h3>
                    <div class="links-list">
                        <a href="#" class="link">
                            More Integrations
                            <img src="{{ asset('assets/images/for_developers_link_arrow.svg') }}" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <h1 class="semibold-font text-align-center" style="margin-top: 175px;">
            Devonics for...
        </h1>
        <h3 class="light-font text-align-center">
            Choose your adventure
        </h3>
        <div class="row image-cards-wrapper" style="padding-top: 90px;">
            <div class="col-12 col-md-6 col-xl-3">
                <div class="image-card">
                    <div class="image-card-header">
                        <img src="{{ asset('assets/images/article-preview/gaming.jpg') }}" alt="">
                    </div>
                    <div class="image-card-content">
                        <p class="title">Gaming</p>
                        <p class="description">Bring players back to your game</p>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6 col-xl-3">
                <div class="image-card">
                    <div class="image-card-header">
                        <img src="{{ asset('assets/images/article-preview/news.jpg') }}" alt="">
                    </div>
                    <div class="image-card-content">
                        <p class="title">News/Media</p>
                        <p class="description">Increase loyalty and impressions</p>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6 col-xl-3">
                <div class="image-card">
                    <div class="image-card-header">
                        <img src="{{ asset('assets/images/article-preview/ecommerce.jpg') }}" alt="">
                    </div>
                    <div class="image-card-content">
                        <p class="title">eCommerce</p>
                        <p class="description">Increase your revenue</p>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6 col-xl-3">
                <div class="image-card">
                    <div class="image-card-header">
                        <img src="{{ asset('assets/images/article-preview/mobile.jpg') }}" alt="">
                    </div>
                    <div class="image-card-content">
                        <p class="title">Mobile</p>
                        <p class="description">Retain and grow audience</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="block pt-5 pb-5"
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
