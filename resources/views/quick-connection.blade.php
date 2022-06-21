@extends('layouts.contact')



@section('content')

<div class="backround">
    <div class="conp_left_corner"></div>
    <div class="right_corner"></div>
</div>
<div class="con_logo">
    <img src="./assets/images/logo.svg" alt="" />
</div>
<h1 class="con_greating">Quick connection</h1>
<form class="connection_form">
    <div class="field">
        <label for="first_name">First name</label>
        <input id="first_name" name="first_name" type="text" />
    </div>
    <div class="field">
        <label for="last_name">Last name</label>
        <input id="last_name" name="last_name" type="text" />
    </div>
    <div class="field">
        <label for="email">Company email address</label>
        <input id="email" name="email" type="email" />
    </div>
    <div class="field">
        <label for="company_name">Company name</label>
        <input id="company_name" name="company_name" type="text" />
    </div>
    <div class="field">
        <label for="phone_number">Phone number</label>
        <input id="phone_number" name="phone_number" type="tel" />
    </div>

    <div class="additional_information">
        <label for="additional_information">Anything else?</label>
        <textarea name="additional_information" id="additional_information" cols="24" rows="4" placeholder="Tell us about your project, 
needs, and timeline."></textarea>
    </div>

    <button class="contact_button">Contact us</button>
</form>


@endsection