@extends('layouts.push')

@section('content')

<div class="mpp_description_block">
    <div class="mpp_push_types">
        <h2 class="mpp_push_types_header">4 Types of Push</h2>

        <div class="mpp_push_types_list">
            <a class="mpp_push_types_list_btn " href="#">User Messages</a>
            <a class="mpp_push_types_list_btn " href="#">Transactional Notification</a>
            <a class="mpp_push_types_list_btn " href="#">Conversion Driver</a>
            <a class="mpp_push_types_list_btn " href="#">Promos & Updates</a>
        </div>

        <div class="mpp_push_types_description">
            <p>
                Let someone know when their username is mentioned in a thread or if
                someone direct messages them through your app.
            </p>
        </div>

        <div class="mpp_header_image"><img src="" alt="" /></div>
    </div>
    <div class="mpp_technology_descrition">
        <h2 class="mpp_technology_descrition_title">Every App Needs Push</h2>
        <p class="mpp_technology_descrition_content">
            When you pick up your phone, the first messages you see are push
            notifications — maybe there’s a breaking news alert, game update,
            response from a dating site. Whatever it is, chances are it came from
            us. Push notifications are the top driver of app re-engagement and
            OneSignal is the #1 SDK used by app developers.
        </p>
        <div class="mpp_header_image"><img src="" alt="" /></div>
    </div>
    <div class="mpp_learn_more_block">
        <p>
            Our platform support iOS, Android, and more so you can easily send
            eye-catching notifications across different mobile devices.
        </p>
        <div class="white_blocks_mobile">
            <div class="white_block_mobile"></div>
            <div class="white_block_mobile"></div>
            <div class="white_block_mobile"></div>
        </div>
        <a href="#">Learn More About Our iOS and Android Notification Capabilities
        </a>
    </div>
    <div class="mpp_quote_container">
        <div class="mpp_quote_container_circle"></div>
        <p class="mpp_quote">
            OneSignal's push notifications have been instrumental in helping us to
            reach our goals. They are quick to implement and use. We use push
            notifications throughout our user's journey.
        </p>
        <p class="mpp_author">Tracy Chang</p>
        <p class="mpp_author_position">VP of Digital Marketing</p>
        <a href="#" class="mpp_read_more">Read Case Study</a>
    </div>

    <div class="mpp_about_product">
        <div class="gp_header_image"><img src="" alt="" /></div>
        <div class="mpp_about_product_description">
            <h2 class="mpp_about_product_description_title">
                Send Messages That Maximize Your Reach
            </h2>
            <p>
                On average, 52% of app users subscribe to push notifications. Get
                more by providing a reason to opt-in before the required push
                permission pop-up. OneSignal includes a free in-app message for this
                very purpose!
            </p>
            <p>
                See how it works with
                <a href="#">our push notification preview tool!</a>
            </p>
        </div>
    </div>
    <div class="mpp_about_product">
        <div class="mpp_about_product_description">
            <h2 class="mpp_about_product_description_title">Ensure Relevancy</h2>
            <p>
                Create <a href="#"> customized Journeys</a> to send relevant
                messaging based on user attributes or behavior - for example, set a
                follow-up message for 24 hours after they download the app. Or
                select <a href="#"> Intelligent Delivery</a> and we'll leverage
                machine learning to drastically improve your CTR.
            </p>
        </div>
        <div class="mpp_header_image"><img src="" alt="" /></div>
    </div>

    <div class="mpp_article_preview_block">
        <div class="mpp_article_preview_header">
            <h2 class="dp_article_preview_title">Stay up to Date</h2>
            <p class="dp_article_preview_subtitle">Read up on best practices before sending your first push notification.
            </p>
        </div>

        <div class="dp_article_preview">
            <div class="dp_article_preview_image">
                <img src="../assets/images/article-preview/news.jpg" alt="" />
            </div>
            <div class="dp_article_preview_descrition">
                <p class="dp_block_title">Gaming</p>
                <p class="dp_block_content">Bring players back to your game</p>
            </div>
        </div>

        <div class="dp_article_preview">
            <div class="dp_article_preview_image">
                <img src="../assets/images/article-preview/gaming.jpg" alt="" />
            </div>

            <div class="dp_article_preview_descrition">
                <p class="dp_block_title">News/Media</p>
                <p class="dp_block_content">Increase loyalty and impressions</p>
            </div>
        </div>

        <div class="dp_article_preview">
            <div class="dp_article_preview_image">
                <img src="../assets/images/article-preview/ecommerce.jpg" alt="" />
            </div>
            <div class="dp_article_preview_descrition">
                <p class="dp_block_title">eCommerce</p>
                <p class="dp_block_content">Increase your revenue</p>
            </div>
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
                <a class="dp_start_btn" href='login'>Get Started Now</a>
                <a class="dp_contact_btn" href='/contact-us'>Contact Sales</a>
            </div>
            <p class="dp_contact_us">
                Have questions?
                <a class="dp_contact_us_link" href="#">Chat with an expert.</a>
            </p>
        </div>
    </div>

    @endsection