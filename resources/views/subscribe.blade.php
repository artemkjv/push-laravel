@extends('layouts.contact')

@section('content')


<div class="docp_top_menu">
    <div class="docp_logo">
        <img class="docp_logo_picture" src="../assets/images/logo.svg" alt="" />
    </div>
    <div class="dp_registration_buttons">
        <a class="dp_signin dp_btn">Log in</a>
        <a class="dp_signup dp_btn">Sign up</a>
    </div>
</div>

<!-- menu -->
<div class="sp_content_back">
    <div class="sp_content">
        <div class="sp_text">
            <div class="sp_text_block">
                <p class="sp_text_block_title">Powerful Messaging</p>
                <p class="sp_text_block_text">
                    Unlimited mobile, up to 10K web push subscribers, email, SMS & 1
                    in-app message
                </p>
            </div>
            <div class="sp_text_block">
                <p class="sp_text_block_title">Quick setup</p>
                <p class="sp_text_block_text">
                    Our users are up and running in under 15 minutes.
                </p>
            </div>
            <div class="sp_text_block">
                <p class="sp_text_block_title">
                    Trusted by millions of leading businesses
                </p>
                <p class="sp_text_block_text">
                    We power messaging for over 10%+ of all mobile apps and 4% of top
                    websites worldwide, and we send 10 billion+ messages per day.
                </p>
            </div>
        </div>
        <form action="" class="sp_create_acc_form">
            <h3 class="sp_form_title">Get Started With OneSignal Free</h3>
            <div class="sp_field">
                <label for="email">Email Address</label><input type="email" class="sp_input" id="email" />
            </div>
            <div class="sp_field">
                <label for="password">Password</label><input type="password" class="sp_input" id="password" />
            </div>
            <div class="sp_field">
                <label for="name">Company or Organization Name</label><input type="text" class="sp_input" id="name" />
            </div>
            <p class="sp_span">
                By signing up to OneSignal you agree to our Terms of Service and
                Privacy Policy.
            </p>
            <a href="" class="sp_crate_acc">Create Account</a>
            <p class="sp_devider">or</p>

            <div class="sp_sign_up_social_media">
                <a href="" class="sp_sign_up_social_media_button"><img src="../assets/images/signup/google.svg" alt="" /> Google</a><a href="" class="sp_sign_up_social_media_button"><img src="../assets/images/signup/github.svg" alt="" /> GitHub</a><a href="" class="sp_sign_up_social_media_button"><img src="../assets/images/signup/facebook.svg" alt="" />
                    Facebook</a>
            </div>
        </form>
    </div>
</div>

@endsection