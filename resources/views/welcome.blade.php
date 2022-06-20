@extends('layouts.app')
@section('app-config')
style="background-repeat: no-repeat; background-size: cover; background-image: url('{{ asset('assets/images/header_background.svg') }}'); background-attachment: fixed; padding-bottom: 0;"
@endsection
@section('content')
<div class="dp_adventages_back">
    <div class="dp_description_block">
        <h2 class="dp_description_block_title">
            Everything You’re Looking For in One Tool
        </h2>
        <p class="dp_description_block_subtitle">
            It’s never been easier to connect with customers.
        </p>
        <div class="dp_learn_about_container">
            <div class="dp_learn_about_block">
                <p class="dp_block_title">Mobile Push Notifications</p>
                <p class="dp_block_content">
                    Be the first message customers see when they pick up their phones.
                    Notifications are the primary traffic source for most mobile apps.
                </p>
            </div>
            <div class="dp_learn_about_block">
                <p class="dp_block_title">Web Push Notifications</p>
                <p class="dp_block_content">
                    Stay in front of your customers even after they leave your site.
                    Works on Chrome, Safari, Firefox, Edge, Opera, and Yandex.
                </p>
            </div>
            <div class="dp_learn_about_block">
                <p class="dp_block_title">Email</p>
                <p class="dp_block_content">
                    Design emails that look great on every device with the drag-and
                    drop composer. Customize our free templates to match your brand.
                </p>
            </div>
            <div class="dp_learn_about_block learn_about_row_2">
                <p class="dp_block_title">In-App Messages</p>
                <p class="dp_block_content">
                    Deliver messages that create delight. Design banners, pop-ups, and
                    interstitials; implement without a single line of code.
                </p>
            </div>
            <div class="dp_learn_about_block">
                <p class="dp_block_title">SMS</p>
                <p class="dp_block_content">
                    Reach customers directly on their phone for higher engagement.
                    Communicate with customers who don’t have your app or a
                    smartphone.
                </p>
            </div>
            <div class="dp_learn_about_block">
                <p class="dp_block_title">Journeys</p>
                <p class="dp_block_content">
                    Seamlessly manage your messaging across channels with our
                    easy-to-use messaging workflow builder, all with no code required.
                </p>
            </div>
        </div>
    </div>
    <div class="dp_advantages_block">
        <div class="dp_advantages_header">
            <h2 class="dp_advantages_block_title">
                Key to Success for Marketers
            </h2>
            <p class="dp_advantages_block_subtitle">
                Connect with your audience the right way
            </p>
        </div>
        <div class="dp_advantages_item">
            <p class="dp_block_title">15 Minute Setup</p>
            <p class="dp_block_content">
                Our users are always shocked at how easy it is to get started.
            </p>
        </div>
        <div class="dp_advantages_item">
            <p class="dp_block_title">Real-Time Reporting</p>
            <p class="dp_block_content">
                View delivery and conversion performance for every message.
            </p>
        </div>
        <div class="dp_advantages_item">
            <p class="dp_block_title">Incredible Scalability</p>
            <p class="dp_block_content">
                Millions of users? No problem. We send out billions of notifications
                daily.
            </p>
        </div>
        <div class="dp_advantages_item">
            <p class="dp_block_title">A/B Testing</p>
            <p class="dp_block_content">
                Compare message performance and automatically send the best.
            </p>
        </div>
        <div class="dp_advantages_item">
            <p class="dp_block_title">Superior Segmentation</p>
            <p class="dp_block_content">
                Create personalized messages and send them to the right audiences.
            </p>
        </div>
        <div class="dp_advantages_item">
            <p class="dp_block_title">Automated Messaging</p>
            <p class="dp_block_content">
                Set it and forget it. You can trigger notifications based on user
                behavior.
            </p>
        </div>
        <div class="dp_advantages_item">
            <p class="dp_block_title">Intelligent Delivery</p>
            <p class="dp_block_content">
                Leverage machine learning to send your messages at the optimal time.
            </p>
        </div>
        <div class="dp_advantages_item">
            <p class="dp_block_title">Analyze Results Anywhere</p>
            <p class="dp_block_content">
                Our SDKs are open source and every component is accessible via API.
            </p>
        </div>
    </div>
</div>
<div class="dp_background">
    <div class="dp_for_developers">
        <div class="dp_technologies">
            <div class="dp_technologies_header">
                <p class="dp_technologies_title">Loved by Developers</p>
                <p class="dp_technologies_subtitle">
                    Our founders were developers who built OneSignal out of a personal
                    need. We've made it easy for any business to get running and to
                    get amazing results. All in less than 10 lines of code.
                </p>
            </div>

            <div class="dp_technologies_list">
                <a href="#" class="dp_technologies_list_item">Apple iOS</a>
                <a href="#" class="dp_technologies_list_item">Android</a>
                <a href="#" class="dp_technologies_list_item">Web Push</a>
                <a href="#" class="dp_technologies_list_item">React Native</a>
                <a href="#" class="dp_technologies_list_item">Unity</a>
                <a href="#" class="dp_technologies_list_item">Flutter</a>
            </div>
            <div class="dp_technologies_links_list">
                <a href="#" class="dp_technologies_link">Read The Getting Started Docs
                    <img src="./assets/images/for_developers_link_arrow.svg" alt="" /></a>
                <a href="#" class="dp_technologies_link">Get Your Free API Key
                    <img src="./assets/images/for_developers_link_arrow.svg" alt="" /></a>
            </div>
        </div>
        <div class="dp_for_developers_image_block"><img src="" alt="" /></div>
        <div class="dp_bottom_block">
            <p class="dp_bottom_block_info">
                Code in any language. We provide native support for every
                development environment.
            </p>
            <p class="dp_bottom_block_info">30+ Platform Integrations</p>
        </div>
    </div>
</div>

<div class="dp_integration_block">
    <div class="dp_integration_block_image"><img src="" alt="" /></div>
    <div class="dp_integration_block_content">
        <p class="dp_integration_block_content_title">Limitless Integrations</p>
        <p class="dp_integration_block_content_text">
            OneSignal integrates with leading analytics, CMS, and eCommerce
            solutions including Amplitude, Mixpanel, Segment, HubSpot, Shopify,
            WordPress, and many more.
        </p>
        <p class="dp_integration_block_content_text">
            Sync audiences and user data to trigger real-time messages.
        </p>
        <a href="#" class="dp_integration_block_content_link">
            More Integrations
            <img src="./assets/images/for_developers_link_arrow.svg" alt="" /></a>
    </div>
</div>

<div class="dp_article_preview_container">
    <div class="dp_article_preview_header">
        <h2 class="dp_article_preview_title">OneSignal for…</h2>
        <p class="dp_article_preview_subtitle">Choose your adventure</p>
    </div>

    <div class="dp_article_preview">
        <div class="dp_article_preview_image">
            <img src="../assets/images/article-preview/mobile.jpg" alt="" />
        </div>
        <div class="dp_article_preview_descrition">
            <p class="dp_block_title">Gaming</p>
            <p class="dp_block_content">Bring players back to your game</p>
        </div>
    </div>

    <div class="dp_article_preview">
        <div class="dp_article_preview_image">
            <img src="../assets/images/article-preview/ecommerce.jpg" alt="" />
        </div>

        <div class="dp_article_preview_descrition">
            <p class="dp_block_title">News/Media</p>
            <p class="dp_block_content">Increase loyalty and impressions</p>
        </div>
    </div>

    <div class="dp_article_preview">
        <div class="dp_article_preview_image">
            <img src="../assets/images/article-preview/news.jpg" alt="" />
        </div>
        <div class="dp_article_preview_descrition">
            <p class="dp_block_title">eCommerce</p>
            <p class="dp_block_content">Increase your revenue</p>
        </div>
    </div>

    <div class="dp_article_preview">
        <div class="dp_article_preview_image">
            <img src="../assets/images/article-preview/gaming.jpg" alt="" />
        </div>

        <div class="dp_article_preview_descrition">
            <p class="dp_block_title">Mobile</p>
            <p class="dp_block_content">Retain and grow audience</p>
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
            <a class="dp_start_btn" href="{{ route('login') }}">Get Started Now</a> <a class="dp_contact_btn " href="/contact-us">Contact Sales</a>
        </div>
        <p class="dp_contact_us">
            Have questions?
            <a class="dp_contact_us_link" href="#">Chat with an expert.</a>
        </p>
    </div>
</div>

@endsection