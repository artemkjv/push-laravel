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

    <div class="csp_contact_sales_block">
        <h2 class="csp_contact_sales_title">Schedule a Demo</h2>
        <p class="csp_contact_sales_subtitle">
            Get started with OneSignal’s multichannel engagement today.
        </p>
        <div class="csp_circles">
            <div class="aup_team_block_teammates_teammate">
                <img src="" alt="" />
            </div>
            <div class="aup_team_block_teammates_teammate">
                <img src="" alt="" />
            </div>
            <div class="aup_team_block_teammates_teammate">
                <img src="" alt="" />
            </div>
        </div>
        <div class="csp_contact_form">
            <div class="csp_contact_sales_description">
                <div class="csp_contact_sales_description_block">
                    <p class="csp_contact_sales_description_block_title">
                        Improve conversion
                    </p>
                    <p class="csp_contact_sales_description_block_text">
                        Get up to 30x with push notifications.
                    </p>
                </div>
                <div class="csp_contact_sales_description_block">
                    <p class="csp_contact_sales_description_block_title">
                        Boost engagement
                    </p>
                    <p class="csp_contact_sales_description_block_text">
                        Reach users on all devices: iOS, Android, Web.
                    </p>
                </div>
                <div class="csp_contact_sales_description_block">
                    <p class="csp_contact_sales_description_block_title">
                        We're the market leader
                    </p>
                    <p class="csp_contact_sales_description_block_text">
                        We deliver over 8 billion messages a day
                    </p>
                </div>
            </div>
            <form action="">
                <fieldset class="csp_contact_sales_container">
                    <div class="csp_contact_sales_field">
                        <label for="csp_contact_sales_first_name">First name</label>
                        <input id="csp_contact_sales_first_name" name="first_name" type="text" />
                    </div>
                    <div class="csp_contact_sales_field">
                        <label for="csp_contact_sales_last_name">Last name</label>
                        <input id="csp_contact_sales_last_name" name="last_name" type="text" />
                    </div>
                    <div class="csp_contact_sales_field">
                        <label for="ecsp_contact_sales_mail">Company email address</label>
                        <input id="csp_contact_sales_email" name="email" type="email" />
                    </div>
                    <div class="csp_contact_sales_field">
                        <label for="csp_contact_sales_company_name">Company name</label>
                        <input id="csp_contact_sales_company_name" name="company_name" type="text" />
                    </div>
                    <div class="csp_contact_sales_field">
                        <label for="csp_contact_sales_phone_number">Phone number</label>
                        <input id="csp_contact_sales_phone_number" name="phone_number" type="tel" />
                    </div>

                    <div class="csp_contact_sales_additional_information_field">
                        <label for="csp_contact_sales_additional_information">Anything else?</label>
                        <textarea name="csp_contact_sales_additional_information" id="csp_contact_sales_additional_information" cols="24" rows="4" placeholder="Tell us about your project, needs, and timeline."></textarea>
                    </div>

                    <button class="csp_contact_sales_contact_button">Contact us</button>
                    <p class="csp_link">
                        If you need support instead,
                        <a href="#">chat with the support team.</a>
                    </p>
                </fieldset>
            </form>
        </div>
    </div>

    @endsection