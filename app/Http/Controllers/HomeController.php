<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home.index');
    }

    public function aboutUs(){
        return view('about-us');
    }

    public function mobilePush() {
        return view('mobile-push');
    }

    public function webPush() {
        return view('web-push');
    }

    public function email() {
        return view('email');
    }

    public function inApp() {
        return view('in-app-messages');
    }

    public function sms() {
        return view('sms');
    }

    public function journeys() {
        return view('journeys');
    }

    public function gaming() {
        return view('gaming');
    }

    public function ecommerce() {
        return view('ecommerce');
    }

    public function contactUs() {
        return view('contact-us');
    }

    public function quickConnection() {
        return view('quick-connection');
    }

    public function documentation() {
        return view('documentation');
    }

    public function price() {
        return view('price');
    }

    public function careers() {
        return view('careers');
    }

    public function news() {
        return view('news');
    }

    public function subscribe() {
        return view('subscribe');
    }

    public function partnerProgram() {
        return view('partner-program');
    }

    public function partnerLogin() {
        return view('partner-login');
    }

    public function apply() {
        return view('apply');
    }

}
