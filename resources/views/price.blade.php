@extends('layouts.push')

@section('content')

<div class="pp_suscribtion_plans_header">
    <h1 class="pp_suscribtion_plans_title">
        Transparent Pricing for Every Stage of Growth
    </h1>
    <h2 class="pp_subtitle">Choose the right plan for your business.</h2>
</div>

<div class="pp_suscribtion_plans">
    <div class="pp_suscription_paln">
        <div class="pp_top_description">
            <div class="pp_suscription_paln_name">
                <h3 class="pp_suscription_paln_name_free">Free</h3>
                <p>Powerful essentials for small businesses</p>
            </div>
            <div class="pp_suscription_paln_price">
                <h3 class="pp_suscription_paln_price_free">$0/Month</h3>
                <p>Unlimited push subscribers * 1 in-app message Email & SMS</p>
            </div>
        </div>

        <ul class="pp_suscription_paln_conditions">
            <a class="pp_start pp_btn pp_start_btn" href="#">Get Started Now</a>
            Free access to:
            <li>Limited Personalization</li>
            <li>Unlimited API Sends</li>
            <li>Intelligent Delivery</li>
            <li>A/B Testing</li>
            <li>GDPR Compliant</li>
        </ul>
    </div>
    <div class="pp_suscription_paln">
        <div class="pp_top_description">
            <div class="pp_suscription_paln_name">
                <h3>Growth</h3>
                <p>Fundamentals to help startups scale</p>
            </div>
            <div class="pp_suscription_paln_price">
                <h3>Starts at <span class="pp_span_highlighted">$9/Month</span></h3>
                <p>
                    $3 per 1,000 push subscribers $3 per 1,000 in-app impressions
                    Email & SMS
                </p>
                <div class="pp_range_container">
                    <label class="pp_label_range"><span>0</span><span>100,000+</span></label>
                    <input type="range" value="0" min="0" max="100000" step="1000" id="" class="pp_range pp_growth" />
                    <p class="pp_subscribers_quantity_growth">0 subscribers</p>
                </div>
            </div>
        </div>

        <ul class="pp_suscription_paln_conditions">
            <a class="pp_start pp_btn pp_start_btn" href="#">Get Started Now</a>
            All features from
            <span class="pp_span_highlighted"> Free +</span>
            <li>Standard Personalization</li>
            <li>Advanced In-App Messaging</li>
            <li>List Uploads</li>
            <li>Confirmed Delivery</li>
            <li>GDPR Compliant + DPA</li>
        </ul>
    </div>
    <div class="pp_suscription_paln">
        <div class="pp_top_description">
            <div class="pp_suscription_paln_name">
                <h3>Professional</h3>
                <p>Advanced features to drive conversions</p>
            </div>
            <div class="pp_suscription_paln_price">
                <h3>
                    Starts at <span class="pp_span_highlighted">$99/Month</span>
                </h3>
                <p>
                    $3 per 1,000 push subscribers $3 per 1,000 in-app impressions
                    Email & SMS
                </p>
                <div class="pp_range_container">
                    <label class="pp_label_range"><span>0</span><span>500,000+</span></label>
                    <input type="range" value="12000" min="0" max="500000" step="1000" id="" class="pp_range pp_professional" />
                    <p class="pp_subscribers_quantity_professional">0 subscribers</p>
                </div>
            </div>
        </div>

        <ul class="pp_suscription_paln_conditions">
            <a class="pp_start pp_btn pp_start_btn" href="#">Get Started Now</a>
            All features from
            <span class="pp_span_highlighted">Growth +</span>

            <li>Advanced Personalization</li>
            <li>CSV Exports</li>
            <li>Advanced Analytics</li>
            <li>Custom Event Tracking</li>
            <li>24/7 Prioritized Email</li>
        </ul>
    </div>
    <div class="pp_suscription_paln">
        <div class="pp_top_description">
            <div class="pp_suscription_paln_name">
                <h3>Enterprise</h3>
                <p>Ultimate control and support for businesses</p>
            </div>
            <div class="pp_suscription_paln_price">
                <h3>Custom</h3>
                <p>
                    Custom subscribers, impressions, email & SMS sends at annual
                    volume-based pricing
                </p>
            </div>
        </div>
        <ul class="pp_suscription_paln_conditions">
            <a class="pp_start pp_btn pp_start_btn" href="#">Get Started Now</a>
            All features from
            <span class="pp_span_highlighted">Professional +</span>
            <li>Custom Segments & Tags</li>
            <li>Custom Contract, SLA & DPA</li>
            <li>Onboarding & 24/7 Support</li>
            <li>Admin Controlled 2FA</li>
            <li>Advanced User Permissions</li>
        </ul>
    </div>
</div>

<div class="pp_price_table_container">
    <h1 class="pp_price_table_title">Comprehensive Feature Breakdown</h1>
    <h2 class="pp_subtitle">
        Compare the features and benefits of each plan.
    </h2>
    <div class="pp_subscriptions">
        <div class="pp_subscription">
            <p class="pp_subscription_title">Free</p>
            <p class="pp_subscription_subtitle">$0/Month</p>

            <a href="" class="pp_subscription_button">Get Started Now</a>
        </div>
        <div class="pp_subscription">
            <p class="pp_subscription_title">Growth</p>
            <p class="pp_subscription_subtitle">Starts at $9/Month</p>

            <a href="" class="pp_subscription_button">Get Started Now</a>
        </div>
        <div class="pp_subscription">
            <p class="pp_subscription_title">Professional</p>
            <p class="pp_subscription_subtitle">Starts at $99/Month</p>

            <a href="" class="pp_subscription_button">Get Started Now</a>
        </div>
        <div class="pp_subscription">
            <p class="pp_subscription_title">Enterprise</p>
            <p class="pp_subscription_subtitle">Custom</p>

            <a href="" class="pp_subscription_button">Contact Sales</a>
        </div>
    </div>
    <table class="pp_price_table" cellspacing="0" cellpadding="0">
        <thead>
            <tr>
                <th class="pp_table_header" colspan="5">Details</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Push Notifications</td>
                <td>Unlimited</td>
                <td>Unlimited</td>
                <td>Unlimited</td>
                <td>Unlimited</td>
            </tr>
            <tr>
                <td>Audience Segments</td>
                <td>6</td>
                <td>10</td>
                <td>20</td>
                <td>Custom</td>
            </tr>
            <tr>
                <td>Data Tags</td>
                <td>10</td>
                <td>20</td>
                <td>100</td>
                <td>Custom</td>
            </tr>
            <tr>
                <td>Active Automated Messages</td>
                <td>3</td>
                <td>10</td>
                <td>100</td>
                <td>Custom</td>
            </tr>
        </tbody>
        <thead>
            <tr>
                <th class="pp_table_header" colspan="5">Journeys</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Active Journeys</td>
                <td><span class="pp_empty_cell"></span></td>
                <td><span class="pp_empty_cell"></span></td>
                <td>3</td>
                <td>100</td>
            </tr>
            <tr>
                <td>Message Steps</td>
                <td><span class="pp_empty_cell"></span></td>
                <td><span class="pp_empty_cell"></span></td>
                <td>6</td>
                <td>20</td>
            </tr>
            <tr>
                <td>Branching</td>
                <td><span class="pp_empty_cell"></span></td>
                <td><span class="pp_empty_cell"></span></td>
                <td>
                    <img src="./assets/images/checkmark_price_table.svg" alt="" />
                </td>
                <td>
                    <img src="./assets/images/checkmark_price_table.svg" alt="" />
                </td>
            </tr>
        </tbody>
        <thead>
            <tr>
                <th class="pp_table_header" colspan="5">Product Features</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Product Features</td>
                <td>Unlimited</td>
                <td>Unlimited</td>
                <td>Unlimited</td>
                <td>Unlimited</td>
            </tr>
            <tr>
                <td>A/B Testing</td>
                <td>Basic</td>
                <td>Basic</td>
                <td>Advanced</td>
                <td>Advanced</td>
            </tr>
            <tr>
                <td colspan="5">Personalized Notifications</td>
            </tr>
            <tr>
                <td colspan="5">Timezone Delivery</td>
            </tr>
            <tr>
                <td colspan="5">Category Opt In Prompt</td>
            </tr>
            <tr>
                <td colspan="5">Intelligent Delivery</td>
            </tr>
            <tr>
                <td colspan="5">Data Protection</td>
            </tr>
            <tr>
                <td colspan="5">Time Delayed Sends</td>
            </tr>
            <tr>
                <td colspan="5">Confirmed Deliveries</td>
            </tr>
            <tr>
                <td colspan="5">Message Throttling</td>
            </tr>
            <tr>
                <td colspan="5">Custom Data Uploads</td>
            </tr>
            <tr>
                <td colspan="5">Push & SMS Retargeting</td>
            </tr>
            <tr>
                <td colspan="5">Advanced Analytics</td>
            </tr>
            <tr>
                <td colspan="5">Custom Outcome Tracking</td>
            </tr>
            <tr>
                <td colspan="5">Notification Data Exports (CSV)</td>
            </tr>
            <tr>
                <td colspan="5">Notification History API</td>
            </tr>
            <tr>
                <td colspan="5">User Activity Timeline</td>
            </tr>
            <tr>
                <td colspan="5">Frequency Capping</td>
            </tr>

            <tr>
                <td>GDPR</td>
                <td>Compliant</td>
                <td>Compliant/ w DPA</td>
                <td>Compliant/ w DPA</td>
                <td>Compliant/ w DPA</td>
            </tr>
            <tr>
                <td>Two-Factor Authentication</td>
                <td>User Controlled</td>
                <td>User Controlled</td>
                <td>User Controlled</td>
                <td>Admin Controlled</td>
            </tr>
            <tr>
                <td>User Permissions</td>
                <td>Multi-User</td>
                <td>Multi-User</td>
                <td>Multi-User + Read Only</td>
                <td>Multi-User + Read Only</td>
            </tr>
            <tr>
                <td>Integrations</td>
                <td>30+ Core</td>
                <td>30+ Core plus</td>
                <td>30+ Core plus</td>
                <td>30+ Core plus</td>
            </tr>
        </tbody>
        <thead>
            <tr>
                <th class="pp_table_header" colspan="5">In-App Messaging</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>In-App Message Impressions</td>
                <td>Unlimited</td>
                <td>$3 / 1,000</td>
                <td>$3 / 1,000</td>
                <td>$3 / 1,000</td>
            </tr>
            <tr>
                <td>Active In-App Messages</td>
                <td>1</td>
                <td>Unlimited</td>
                <td>Unlimited</td>
                <td>Unlimited</td>
            </tr>
            <tr>
                <td colspan="5">Multi-Card Carousel Messages</td>
            </tr>
            <tr>
                <td colspan="5">Automated In-App Messages</td>
            </tr>
            <tr>
                <td colspan="5">Recurring In-App Messages</td>
            </tr>
            <tr>
                <td colspan="5">No Code Tagging</td>
            </tr>
            <tr>
                <td colspan="5">Custom Outcome Tracking</td>
            </tr>
        </tbody>
        <thead>
            <tr>
                <th class="pp_table_header" colspan="5">Email</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Email Pricing</td>
                <td colspan="4">
                    Free trial through May 1st, 2022. Pricing as below thereafter.
                </td>
            </tr>
            <tr>
                <td>Email Messages</td>
                <td>5,000 (Free)</td>
                <td>$3 / 1,000</td>
                <td>$3 / 1,000</td>
                <td>Custom</td>
            </tr>
            <tr>
                <td colspan="5">Personalized Emails</td>
            </tr>
            <tr>
                <td colspan="5">Drag & Drop Email Composer</td>
            </tr>
            <tr>
                <td colspan="5">Automated Emails</td>
            </tr>
            <tr>
                <td colspan="5">SDK Support</td>
            </tr>
            <tr>
                <td>Dedicated IPs</td>
                <td>Shared IP Only</td>
                <td>Shared IP Only</td>
                <td>Shared IP Only</td>
                <td>Dedicated IPs Optional</td>
            </tr>
        </tbody>
        <thead>
            <tr>
                <th class="pp_table_header" colspan="5">SMS</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>SMS Pricing</td>
                <td colspan="4">Free trial. Talk to sales to discuss pricing.</td>
            </tr>
            <tr>
                <td>SMS Messages</td>
                <td>Unlimited</td>
                <td>Unlimited</td>
                <td>Unlimited</td>
                <td>Unlimited</td>
            </tr>
            <tr>
                <td colspan="5">Personalized SMS Messages</td>
            </tr>
            <tr>
                <td colspan="5">Integration with SMS Provider</td>
            </tr>
        </tbody>
        <thead>
            <tr>
                <th class="pp_table_header" colspan="5">Customer Support</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Ongoing Support</td>
                <td>Email</td>
                <td>Prioritized Email</td>
                <td>24/7 Prioritized Email</td>
                <td>24/7 Prioritized Email & SRE On Call Support</td>
            </tr>
            <tr>
                <td colspan="5">Personalized Onboarding Support</td>
            </tr>
            <tr>
                <td colspan="5">Custom Contract & SLA</td>
            </tr>
            <tr>
                <td>Dedicated Support & Professional Services</td>
                <td></td>
                <td></td>
                <td>Available for Purchase</td>
                <td>Available for Purchase</td>
            </tr>
        </tbody>
    </table>
    <div class="pp_price_table_mobile">
        <div class="pp_price_table_mobile_title">
            <p class="pp_table_header">Details</p>
        </div>
        <div class="table_block">
            <div class="table_block_item">
                <p>Push Notifications</p>
                <p>Unlimited</p>
                <p>Unlimited</p>
                <p>Unlimited</p>
                <p>Unlimited</p>
            </div>
            <div class="table_block_item">
                <p>Audience Segments</p>
                <p>6</p>
                <p>10</p>
                <p>20</p>
                <p>
                    <img src="./assets/images/checkmark_price_table.svg" alt="" />
                </p>
            </div>
            <div class="table_block_item">
                <p>Data Tags</p>
                <p>10</p>
                <p>20</p>
                <p>100</p>
                <p>
                    <img src="./assets/images/checkmark_price_table.svg" alt="" />
                </p>
            </div>
            <div class="table_block_item">
                <p>Active Automated Messages</p>
                <p>3</p>
                <p>10</p>
                <p>100</p>
                <p>
                    <img src="./assets/images/checkmark_price_table.svg" alt="" />
                </p>
            </div>
        </div>

        <div class="pp_price_table_mobile_title">
            <p class="pp_table_header">Journeys</p>
        </div>
        <div class="table_block">
            <div class="table_block_item">
                <p>Push Notifications</p>
                <p>Unlimited</p>
                <p>Unlimited</p>
                <p>Unlimited</p>
                <p>Unlimited</p>
            </div>
            <div class="table_block_item">
                <p>Audience Segments</p>
                <p>6</p>
                <p>10</p>
                <p>20</p>
                <p>
                    <img src="./assets/images/checkmark_price_table.svg" alt="" />
                </p>
            </div>
            <div class="table_block_item">
                <p>Data Tags</p>
                <p>10</p>
                <p>20</p>
                <p>100</p>
                <p>
                    <img src="./assets/images/checkmark_price_table.svg" alt="" />
                </p>
            </div>
            <div class="table_block_item">
                <p>Active Automated Messages</p>
                <p>3</p>
                <p>10</p>
                <p>100</p>
                <p>
                    <img src="./assets/images/checkmark_price_table.svg" alt="" />
                </p>
            </div>
        </div>

        <div class="pp_price_table_mobile_title">
            <p class="pp_table_header">Product Features</p>
        </div>
        <div class="table_block">
            <div class="table_block_item">
                <p>Push Notifications</p>
                <p>Unlimited</p>
                <p>Unlimited</p>
                <p>Unlimited</p>
                <p>Unlimited</p>
            </div>
            <div class="table_block_item">
                <p>Audience Segments</p>
                <p>6</p>
                <p>10</p>
                <p>20</p>
                <p>
                    <img src="./assets/images/checkmark_price_table.svg" alt="" />
                </p>
            </div>
            <div class="table_block_item">
                <p>Data Tags</p>
                <p>10</p>
                <p>20</p>
                <p>100</p>
                <p>
                    <img src="./assets/images/checkmark_price_table.svg" alt="" />
                </p>
            </div>
            <div class="table_block_item">
                <p>Active Automated Messages</p>
                <p>3</p>
                <p>10</p>
                <p>100</p>
                <p>
                    <img src="./assets/images/checkmark_price_table.svg" alt="" />
                </p>
            </div>
        </div>

        <div class="pp_price_table_mobile_title">
            <p class="pp_table_header">In-App Messaging</p>
        </div>

        <div class="table_block">
            <div class="table_block_item">
                <p>Push Notifications</p>
                <p>Unlimited</p>
                <p>Unlimited</p>
                <p>Unlimited</p>
                <p>Unlimited</p>
            </div>
            <div class="table_block_item">
                <p>Audience Segments</p>
                <p>6</p>
                <p>10</p>
                <p>20</p>
                <p>
                    <img src="./assets/images/checkmark_price_table.svg" alt="" />
                </p>
            </div>
            <div class="table_block_item">
                <p>Data Tags</p>
                <p>10</p>
                <p>20</p>
                <p>100</p>
                <p>
                    <img src="./assets/images/checkmark_price_table.svg" alt="" />
                </p>
            </div>
            <div class="table_block_item">
                <p>Active Automated Messages</p>
                <p>3</p>
                <p>10</p>
                <p>100</p>
                <p>
                    <img src="./assets/images/checkmark_price_table.svg" alt="" />
                </p>
            </div>
        </div>
        <div class="pp_price_table_mobile_title">
            <p class="pp_table_header">Email</p>
        </div>
        <div class="table_block">
            <div class="table_block_item">
                <p>Push Notifications</p>
                <p>Unlimited</p>
                <p>Unlimited</p>
                <p>Unlimited</p>
                <p>Unlimited</p>
            </div>
            <div class="table_block_item">
                <p>Audience Segments</p>
                <p>6</p>
                <p>10</p>
                <p>20</p>
                <p>
                    <img src="./assets/images/checkmark_price_table.svg" alt="" />
                </p>
            </div>
            <div class="table_block_item">
                <p>Data Tags</p>
                <p>10</p>
                <p>20</p>
                <p>100</p>
                <p>
                    <img src="./assets/images/checkmark_price_table.svg" alt="" />
                </p>
            </div>
            <div class="table_block_item">
                <p>Active Automated Messages</p>
                <p>3</p>
                <p>10</p>
                <p>100</p>
                <p>
                    <img src="./assets/images/checkmark_price_table.svg" alt="" />
                </p>
            </div>
        </div>

        <div class="pp_price_table_mobile_title">
            <p class="pp_table_header">SMS</p>
        </div>
        <div class="table_block">
            <div class="table_block_item">
                <p>Push Notifications</p>
                <p>Unlimited</p>
                <p>Unlimited</p>
                <p>Unlimited</p>
                <p>Unlimited</p>
            </div>
            <div class="table_block_item">
                <p>Audience Segments</p>
                <p>6</p>
                <p>10</p>
                <p>20</p>
                <p>
                    <img src="./assets/images/checkmark_price_table.svg" alt="" />
                </p>
            </div>
            <div class="table_block_item">
                <p>Data Tags</p>
                <p>10</p>
                <p>20</p>
                <p>100</p>
                <p>
                    <img src="./assets/images/checkmark_price_table.svg" alt="" />
                </p>
            </div>
            <div class="table_block_item">
                <p>Active Automated Messages</p>
                <p>3</p>
                <p>10</p>
                <p>100</p>
                <p>
                    <img src="./assets/images/checkmark_price_table.svg" alt="" />
                </p>
            </div>
        </div>

        <div class="pp_price_table_mobile_title">
            <p class="pp_table_header">Customer Support</p>
        </div>
        <div class="table_block">
            <div class="table_block_item">
                <p>Ongoing Support</p>
                <p>Email</p>
                <p>Prioritized Email</p>
                <p>24/7 Prioritized Email</p>
                <p>24/7 Prioritized Email & SRE On Call Support</p>
            </div>

            <div class="table_block_item">
                <p>Dedicated Support & Professional Services</p>
                <p></p>
                <p></p>
                <p>Available for Purchase</p>
                <p>Available for Purchase</p>
            </div>
        </div>
    </div>
</div>
<div class="pp_questions_block pp_decor_price_page">
    <h1 class="pp_questions_block_title">Frequently Asked Questions</h1>
    <div class="pp_questions_list">
        <a class="pp_question" href="#">Which plan should I choose?</a>
        <a class="pp_question" href="#">How do you charge?</a>
        <a class="pp_question" href="#">What is a subscriber?</a>
        <a class="pp_question" href="#">What is an impression?</a>
        <a class="pp_question" href="#">How do I upgrade my plan?</a>
        <a class="pp_question" href="#">How can I pay?</a>
        <a class="pp_question" href="#">Can I pay in my local currency?</a>
        <a class="pp_question" href="#">What if I decide to downgrade or cancel?</a>
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
            <a class="dp_start_btn" href="{{ route('login') }}">Get Started Now</a>
            <a class="dp_contact_btn" href="/contact-us">Contact Sales</a>
        </div>
        <p class="dp_contact_us">
            Have questions?
            <a class="dp_contact_us_link" href="#">Chat with an expert.</a>
        </p>
    </div>
</div>

@endsection