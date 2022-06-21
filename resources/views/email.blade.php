@extends('layouts.push')

@section('content')

<div class="mpp_header_block">
    <div class="mpp_header">
        <h1 class="mpp_title">
            Re-engage Customers with Real-Time Web Push Notifications
        </h1>
        <p class="mpp_header_block_subtitle">
            Build stronger, more valuable customer relationships with desktop and
            browser notifications.
        </p>
        <div class="dp_buttons">
            <a class="dp_start_btn">Get Started Now</a>
            <a class="dp_contact_btn">Contact Sales</a>
        </div>
    </div>
    <div class="mpp_header_image"><img src="" alt="" /></div>
</div>

<div class="ep_description_block ep_email_decor_top">
    <div class="mpp_quote_container">
        <div class="mpp_quote_container_circle"></div>
        <p class="mpp_quote">
            With more than 60 owned and operated sports sites, the USA Today
            Sports Media Group relies on OneSignal to get the right content in
            front of the right fans. From notifications on desktop browsers to
            targeted deep-links into our SportsWire app, OneSignal has made
            engaging our readers fast, simple and effective.
        </p>
        <p class="mpp_author">John Turner</p>
        <p class="mpp_author_position">Director of Business Development</p>
        <a href="#" class="mpp_read_more">Read Case Study</a>
    </div>

    <div class="mpp_about_product">
        <div class="gp_header_image"><img src="" alt="" /></div>
        <div class="mpp_about_product_description">
            <h2 class="mpp_about_product_description_title">
                A Platform Built to Save You Money
            </h2>
            <p>
                Want to send professional looking emails? Typically you have to go
                through high-end marketing email providers, but they get expensive
                fast. A million subscribers could cost you $50K+ per year!
            </p>
            <p>
                Transactional email companies are a fraction of the price, but their
                features are limited. That's why we added Email Composer, a free
                tool built atop the most popular and affordable transactional email
                services: SendGrid, Mailgun, and Mandrill.
            </p>
        </div>
    </div>
    <div class="mpp_about_product">
        <div class="mpp_about_product_description">
            <h2 class="mpp_about_product_description_title">
                Create Emails that Delight
            </h2>
            <p>
                With OneSignal's Email Composer, your messages will look great on
                every device. Start with our free templates and customize them to
                match your unique brand. Use our intuitive drag-and-drop composer
                for a no-code solution, or use our HTML editor for full control.
            </p>
            <p>
                Maximize conversion by ensuring emails are relevant and timely.
                OneSignal's Segmentation Editor makes it easy to target exactly the
                right audience with personalized content based on their location,
                interests, and purchase activity.
            </p>
        </div>
        <div class="mpp_header_image"><img src="" alt="" /></div>
    </div>

    <div class="mpp_about_product">
        <div class="gp_header_image"><img src="" alt="" /></div>
        <div class="mpp_about_product_description">
            <h2 class="mpp_about_product_description_title">
                The Power of Automation in Your Hands
            </h2>
            <p>
                Set up sophisticated automations with OneSignal’s powerful Segments
                and time-based triggers and send timely and relevant communications.
                Automate your sends and personalize your content based on your
                users’ actions and behavior to increase open rates and engagement.
            </p>
        </div>
    </div>
    <div class="mpp_about_product ep_email_decor_botom">
        <div class="mpp_about_product_description">
            <h2 class="mpp_about_product_description_title">
                Easily Grow Your Audience
            </h2>
            <p>
                OneSignal’s customizable web prompt helps you capture your users’
                emails and identify your best customers. The slide prompt can
                automatically synchronize emails, phone numbers, and devices to a
                single user record for both new and existing users.
            </p>
        </div>
        <div class="mpp_header_image"><img src="" alt="" /></div>
    </div>
</div>


<div class="dp_start_now_block_background">
    <div class="dp_start_now_block">
        <div class="dp_start_now_block_header">
            <h1 class="dp_start_now_block_title">
                Get Started Today For Free With Our Tool
            </h1>
            <p class="dp_start_now_block_subtitle">
                We’ll get you going in a matter of minutes.
            </p>
        </div>

        <div class="dp_start_now_block_buttons">
            <a class="dp_start_btn" href='{{ route('login') }}'>Get Started Now</a>
            <a class="dp_start_btn" href='/contact-us'>Get Started Now</a>
        </div>
        <p class="dp_contact_us">
            Have questions?
            <a class="dp_contact_us_link" href="#">Chat with an expert.</a>
        </p>
    </div>
</div>

@endsection