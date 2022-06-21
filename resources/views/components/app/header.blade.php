 <div class="dp_top_block">
     <div class="dp_top_menu">
         <a href="{{route('welcome')}}">
             <div class="dp_logo">
                 <img class="dp_logo_picture" src="./assets/images/logo.svg" alt="" />
             </div>
         </a>
         <ul class="dp_nav_menu">
             <li class="dp_posibilities">
                 <a class="dp_menu_item" href="#">Capabilities </a>

                 <ul class="dp_menu_container menu_container_first">
                     <img class="dp_triangle" src="./assets/images/menu_triangle.svg" alt="" />
                     <ul class="dp_menu_extended">
                         <li><a href="#">Messaging channels </a></li>
                         <li><a href="{{route('mobile-push')}}">Mobile push </a></li>
                         <li><a href="{{route('web-push')}}">Web push </a></li>
                         <li><a href="{{route('in-app-messages')}}">In-App </a></li>
                         <li><a href="{{route('email')}}">Email </a></li>
                         <li><a href="{{ route('sms') }}">SMS </a></li>
                     </ul>
                     <ul class="dp_menu_extended features">
                         <li><a href="#">Features </a></li>
                         <li><a href="{{ route('journeys') }}">Journeys </a></li>
                         <li><a href="#">Personalization </a></li>
                         <li><a href="#">Segmentation </a></li>
                         <li><a href="#">Analytics </a></li>
                         <li><a href="#">A/B Testing </a></li>
                         <li><a href="#">API </a></li>
                     </ul>
                     <div class="dp_devider"></div>
                     <ul class="dp_menu_extended">
                         <li><a href="#">Industries </a></li>
                         <li><a href="{{ route('gaming') }}">Gaming </a></li>
                         <li><a href="{{ route('news') }}">News/Media </a></li>
                         <li><a href="{{ route('ecommerce') }}">eCommerce </a></li>
                         <li><a href="#">Mobile </a></li>
                     </ul>
                 </ul>
             </li>
             <li><a class="dp_menu_item" href="{{ route('price') }}">Pricing </a></li>
             <li><a class="dp_menu_item" href="{{ route('documentation') }}">Documentation</a></li>
             <li class="dp_resources">
                 <a class="dp_menu_item" href="#">Resources </a>

                 <ul class="dp_menu_container">
                     <img class="dp_triangle" src="./assets/images/menu_triangle.svg" alt="" />
                     <ul class="dp_menu_extended">
                         <li><a href="#">Resources </a></li>
                         <li><a href="#">Resource Library </a></li>
                         <li><a href="#">Customer Case Studies </a></li>
                         <li><a href="#">How-To Guides </a></li>
                         <li><a href="#">Demo Videos </a></li>
                     </ul>

                     <div class="dp_devider"></div>
                     <ul class="dp_menu_extended">
                         <li><a href="#">More </a></li>
                         <li><a href="#">Blog </a></li>
                         <li><a href="#">Notification Preview Tool </a></li>
                         <li><a href="#">Integrations </a></li>
                     </ul>
                 </ul>
             </li>

             <li class="dp_company">
                 <a class="dp_menu_item" href="#">Company </a>

                 <ul class="dp_menu_container">
                     <img class="dp_triangle" src="./assets/images/menu_triangle.svg" alt="" />
                     <ul class="dp_menu_extended">
                         <li><a href="#">Company </a></li>
                         <li><a href="{{ route('about-us') }}">About Us </a></li>
                         <li><a href="{{ route('careers') }}">Careers </a></li>
                         <li><a href="#">Newsroom</a></li>
                         <li><a href="{{ route('contact-us') }}">Contact Sales</a></li>
                     </ul>

                     <div class="dp_devider"></div>
                     <ul class="dp_menu_extended">
                         <li>
                             <a href="{{ route('apply') }}">Partner With Onesignal</a>
                         </li>
                         <li><a href="{{ route('partner-program') }}">Partner Program </a></li>
                         <li><a href="{{ route('login') }}">Partner Login </a></li>
                     </ul>
                 </ul>
             </li>
         </ul>
         <div class="dp_registration_buttons">
             <a class="dp_signin dp_btn" href="{{ route('login') }}">Log in</a>
             <a class="dp_signup dp_btn" href="{{ route('register') }}">Sign up</a>
         </div>
     </div>
     <div class="mobile_top_block">
         <div class="mobile_top_visible">
             <div class="mobile_top_visible_logo">
                 <img class="dp_logo_picture" src="./assets/images/logo.svg" alt="" />
             </div>
             <div class="dp_registration_buttons_mobile">
                 <a class="dp_signin_mobile" href="{{ route('login') }}">Log in</a>
                 <a class="dp_signup_mobile" href="{{ route('register') }}">Sign up</a>
             </div>
             <div class="gamburger">
                 <span></span>
                 <span></span>
                 <span></span>
             </div>
         </div>
         <div class="dp_menu_extend not_visible">
             <ul class="dp_menu_extend_nav_menu">
                 <li>
                     <a class="dp_menu_item" href="#">Capabilities </a>

                     <a href="#" class="dp_menu_extended_mobile_item">Messaging channels
                     </a>

                     <ul class="dp_menu_extended_mobile">
                         <li><a href="{{ route('mobile-push') }}">Mobile push </a></li>
                         <li><a href="{{ route('web-push') }}">Web push </a></li>
                         <li><a href="{{ route('in-app-messages') }}">In-App </a></li>
                         <li><a href="{{ route('email') }}">Email </a></li>
                         <li><a href="{{ route('sms') }}">SMS </a></li>
                     </ul>
                     <a href="#" class="dp_menu_extended_mobile_item">Features </a>

                     <ul class="dp_menu_extended_mobile">
                         <li><a href="{{ route('journeys') }}">Journeys </a></li>
                         <li><a href="#">Personalization </a></li>
                         <li><a href="#">Segmentaion </a></li>
                         <li><a href="#">Analytics </a></li>
                         <li><a href="#">A/B Testing </a></li>
                         <li><a href="#">API </a></li>
                     </ul>
                     <a href="#" class="dp_menu_extended_mobile_item">Industries </a>
                     <ul class="dp_menu_extended_mobile">
                         <li><a href="{{ route('gaming') }}">Gaming </a></li>
                         <li><a href="{{ route('news') }}">News/Media </a></li>
                         <li><a href="{{ route('ecommerce') }}">eCommerce </a></li>
                         <li><a href="#">Mobile </a></li>
                     </ul>
                 </li>
                 <li class="mobile_not_extended">
                     <a class="dp_menu_item not_extended" href="{{ route('price') }}">Pricing </a>
                 </li>
                 <li class="mobile_not_extended">
                     <a class="dp_menu_item not_extended" href="{{ route('documentation') }}">Documentation</a>
                 </li>
                 <li>
                     <a class="dp_menu_item" href="#">Resources </a>
                     <a href="#" class="dp_menu_extended_mobile_item">Resource Library
                     </a>

                     <ul class="dp_menu_extended_mobile">
                         <li><a href="#">Customer Case Studies </a></li>
                         <li><a href="#">How-To Guides </a></li>
                         <li><a href="#">Demo Videos </a></li>
                     </ul>
                     <a href="#" class="dp_menu_extended_mobile_item">More </a>
                     <ul class="dp_menu_extended_mobile">
                         <li><a href="#">Blog </a></li>
                         <li><a href="#">Notification Preview Tool </a></li>
                         <li><a href="#">Integrations </a></li>
                     </ul>
                 </li>

                 <li>
                     <a class="dp_menu_item" href="#">Company</a>

                     <ul class="dp_menu_extended_mobile">
                         <li><a href="{{ route('about-us') }}">About Us </a></li>
                         <li><a href="{{ route('careers') }}">Careers </a></li>
                         <li><a href="#">Newsroom</a></li>
                         <li><a href="{{ route('contact-us') }}">Contact Sales</a></li>
                     </ul>
                     <a href="{{ route('apply') }}" class="dp_menu_extended_mobile_item">Partner With Onesignal</a>
                     <ul class="dp_menu_extended_mobile">
                         <li><a href="{{ route('partner-program') }}">Partner Program </a></li>
                         <li><a href="{{ route('partner-login') }}">Partner Login </a></li>
                     </ul>
                 </li>
             </ul>
             <div class="dp_registration_buttons_mobile">
                 <a class="dp_signin dp_btn" href="{{ route('login') }}">Log in</a>
                 <a class="dp_signup dp_btn" href="{{ route('register') }}">Sign up</a>
             </div>
         </div>
     </div>
     <div class="dp_header_block">
         <div class="dp_header">
             <h1 class="dp_header_title">Customer Messaging Delivered</h1>
             <p class="dp_header_block_subtitle">
                 The market leading self-serve customer engagement solution for Push
                 Notifications, Email, SMS & In-App.
             </p>
             <div class="dp_buttons">
                 <a class="dp_start_btn" href="{{ route('login') }}">Get Started Now</a>
                 <a class="dp_contact_btn" href="{{ route('contact-us') }}">Contact Sales</a>
             </div>
         </div>
         <div class="dp_header_image">
             <img src="./assets/images/header_picture.svg" alt="" />
         </div>
     </div>
 </div>
