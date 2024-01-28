@extends('front.layouts.header')
@section('css')
<style>
   /* first section*/
   .breadcrumbs-wrap {
   position: relative;
   float: left;
   width: 100%;
   min-height: 1px;
   padding-left: 15px;
   padding-right: 15px;
   }
   .breadcrumbs-wrap p {
   margin: 0px;
   text-transform: uppercase;
   font-size: 12px;
   line-height: 30px;
   font-weight: 300;
   }
   .fa {
   display: inline-block;
   font: normal normal normal 14px/1 FontAwesome;
   font-size: inherit;
   text-rendering: auto;
   -webkit-font-smoothing: antialiased;
   /* -moz-osx-font-smoothing: grayscale; */
   } 
   /* secound section*/
   p{
   display: block;
   margin-bottom: 10px;
   font-size: 16px;
   font-weight: 300;
   margin-top: 5px;
   line-height: 1.6em;
   }
   section {
   margin-left: -15px;
   margin-right: -15px;
   }
   .services-page-intro {
   text-align: center;
   position: relative;
   float: left;
   width: 100%;
   min-height: 1px;
   /* padding-left: 15px;
   padding-right: 15px; */
   padding: 40px 15px;
   }
   /* 3rd section*/
   .smartphones-repair-services .repair-half.in-view {
   /* -moz-transition: all 2s ease;
   -webkit-transition: all 2s ease;
   -ms-transition: all 2s ease;
   -o-transition: all 2s ease; */
   transition: all 2s ease;
   opacity: 1;
   }
   a {
   /* -webkit-transition: all ease .4s;
   -moz-transition: all ease .4s;
   -o-transition: all ease .4s;
   -ms-transition: all ease .4s;
   transition: all ease .4s; */
   color: #ff5e5b;
   text-decoration: none;
   }
   @media (min-width: 992px){
   .smartphones-repair-services .repair-half {
   float: left;
   width: 50%;
   }
   }
   .smartphones-repair-services .repair-half {
   /* position: relative;
   min-height: 1px;
   padding-left: 15px;
   padding-right: 15px; */
   position: relative;
   min-height: 1px;
   padding-left: 60px;
   padding-right: 60px;
   margin-bottom: 100px;
   text-align: center;
   overflow: hidden;
   /* opacity: 0; */
   }
   element.style {
   }
   .smartphones-repair-services .repair-half.iphone-repair.in-view img {
   -moz-transition: all 1.2s ease;
   -webkit-transition: all 1.2s ease;
   -ms-transition: all 1.2s ease;
   -o-transition: all 1.2s ease;
   transition: all 1.2s ease;
   }
   .translatetozero, .product-warranty.in-view, .locator-call.in-view, .prod-image.in-view img, .lower-service-wrap .cost.in-view, .lower-service-wrap .fix.in-view, .device-issues .slick-current .device-issue, .device-issues .slick-current .device-issue#coltwo, .device-issues .slick-current .device-issues-image img, .fixemallwrap .block-image.in-view img, .smartphones-repair-services .repair-half.iphone-repair.in-view img, .smartphones-repair-services .repair-half.smartphone-repair.in-view img, .other-devices .device-block-repair .image-wrapper.in-view img, .devices .device-repair-block.in-view {
   /* -moz-transform: translate(0px, 0px);
   -webkit-transform: translate(0px, 0px);
   -o-transform: translate(0px, 0px);
   -ms-transform: translate(0px, 0px); */
   transform: translate(0px, 0px);
   }
   .smartphones-repair-services .repair-half img {
   display: block;
   max-height: 360px;
   height: auto;
   margin: 40px auto;
   }
   img {
   max-width: 100%;
   backface-visibility: hidden !important;
   backface-visibility: hidden !important;
   /* height: auto;  main */
   }
   .smartphones-repair-services .repair-half h3 {
   color: #1a202a;
   font-size: 1.5em;
   font-weight: 400;
   }
   .rps-top-block h3 a {
   color: #1a202a;
   }
   a {
   /* -webkit-transition: all ease .4s;
   -moz-transition: all ease .4s;
   -o-transition: all ease .4s;
   -ms-transition: all ease .4s; */
   transition: all ease .4s;
   /* color: #ff5e5b; */
   text-decoration: none;
   }
   .smartphones-repair-services .repair-half p {
   text-align: left;
   margin: 15px 0;
   }
   .smartphones-repair-services p {
   color: #5b5f65;
   }
   .smartphones-repair-services .btn, .smartphones-repair-services input[type="submit"], .smartphones-repair-services .advanced-locator button, .advanced-locator .smartphones-repair-services button {
   padding: 10px 30px !important;
   font-size: 0.8em;
   }
   /* .btn.radius, input.radius[type="submit"], .advanced-locator button.radius {
   border-radius: 5px;
   } */
   section:before, section:after {
   content: " ";
   display: table;
   }
   *:before, *:after {
   /* -webkit-box-sizing: border-box;
   -moz-box-sizing: border-box; */
   box-sizing: border-box;
   }
   /* body {
   font-family: "Avenir W01","Helvetica Neue","Helvetica","Arial",sans-serif;
   font-size: 16px;
   line-height: 1.42857;
   color: #1a202a;
   background-color: #fff;
   } */
   .other-devices .device-block-repair.in-view {
   /* -moz-transition: all 1s ease;
   -webkit-transition: all 1s ease;
   -ms-transition: all 1s ease;
   -o-transition: all 1s ease; */
   transition: all 1s ease;
   opacity: 1;
   }
   @media (min-width: 992px){
   .other-devices .device-block-repair {
   float: left;
   width: 33.33333%;
   }
   }
   .other-devices .device-block-repair {
   /* position: relative;
   min-height: 1px;
   padding-left: 15px;
   padding-right: 15px; */
   position: relative;
   /* min-height: 1px; */
   padding-left: 15px;
   padding-right: 15px;
   min-height: 540px;
   margin-bottom: 100px;
   text-align: center;
   /* opacity: 0; */
   }
   .other-devices .device-block-repair .image-wrapper.in-view {
   /* -moz-transition: all 1s ease;
   -webkit-transition: all 1s ease;
   -ms-transition: all 1s ease;
   -o-transition: all 1s ease; */
   transition: all 1s ease;
   opacity: 1;
   }
   .other-devices .device-block-repair .image-wrapper {
   height: 280px;
   display: flex;
   align-items: flex-end;
   justify-content: center;
   overflow: hidden;
   opacity: 0;
   }
   .other-devices .device-block-repair .image-wrapper.in-view img {
   /* -moz-transition: all 1.3s ease;
   -webkit-transition: all 1.3s ease;
   -ms-transition: all 1.3s ease;
   -o-transition: all 1.3s ease; */
   transition: all 1.3s ease;
   }
   element.style {
   }
   .other-devices .device-block-repair .image-wrapper.in-view img {
   -moz-transition: all 1.3s ease;
   -webkit-transition: all 1.3s ease;
   -ms-transition: all 1.3s ease;
   -o-transition: all 1.3s ease;
   transition: all 1.3s ease;
   }
   .translatetozero, .product-warranty.in-view, .locator-call.in-view, .prod-image.in-view img, .lower-service-wrap .cost.in-view, .lower-service-wrap .fix.in-view, .device-issues .slick-current .device-issue, .device-issues .slick-current .device-issue#coltwo, .device-issues .slick-current .device-issues-image img, .fixemallwrap .block-image.in-view img, .smartphones-repair-services .repair-half.iphone-repair.in-view img, .smartphones-repair-services .repair-half.smartphone-repair.in-view img, .other-devices .device-block-repair .image-wrapper.in-view img, .devices .device-repair-block.in-view {
   /* -moz-transform: translate(0px, 0px);
   -webkit-transform: translate(0px, 0px);
   -o-transform: translate(0px, 0px);
   -ms-transform: translate(0px, 0px); */
   transform: translate(0px, 0px);
   }
   .other-devices .device-block-repair img {
   margin: 20px 0;
   }
   .other-devices .device-block-repair .btn, .other-devices .device-block-repair input[type="submit"], .other-devices .device-block-repair .advanced-locator button, .advanced-locator .other-devices .device-block-repair button {
   padding: 10px 30px !important;
   font-size: 0.8em;
   }
   .btn.radius, input.radius[type="submit"], .advanced-locator button.radius {
   border-radius: 5px;
   }
   .btn.blue, input.blue[type="submit"], .advanced-locator button {
   background: #02b9f6;
   color: white;
   }
   .btn, input[type="submit"], .advanced-locator button {
   display: inline-block;
   box-sizing: border-box;
   font-weight: 900;
   text-transform: uppercase;
   max-width: 100%;
   text-align: center;
   letter-spacing: 1px;
   /* padding: 20px 45px;
   font-size: 0.9em; */
   }
   .other-devices .device-block-repair h4 {
   color: #1a202a;
   font-weight: 400;
   font-size: 1.2em;
   margin: 15px 0;
   }
   .other-devices .device-block-repair p {
   color: #1a202a;
   margin: 15px 0;
   }
   element.style {
   }
   .other-devices .device-block-repair p {
   color: #1a202a;
   margin: 15px 0;
   }
   p {
   display: block;
   /* margin-bottom: 10px; */
   font-size: 16px;
   font-weight: 300;
   /* margin-top: 5px; */
   line-height: 1.6em;
   }
   .other-devices .device-block-repair .btn, .other-devices .device-block-repair input[type="submit"], .other-devices .device-block-repair .advanced-locator button, .advanced-locator .other-devices .device-block-repair button {
   padding: 10px 30px !important;
   font-size: 0.8em;
   }
   /* .btn.radius, input.radius[type="submit"], .advanced-locator button.radius {
   border-radius: 5px;
   } */
   hr {
   margin-top: 1rem;
   margin-bottom: 1rem;
   border: 0;
   border-top: 1px solid rgba(0,0,0,0.1);
   }
   hr {
   display: block;
   unicode-bidi: isolate;
   margin-block-start: 0.5em;
   margin-block-end: 0.5em;
   margin-inline-start: auto;
   margin-inline-end: auto;
   /* overflow: hidden;
   border-style: inset;
   border-width: 1px; */
   }
   hr {
   box-sizing: content-box;
   height: 0;
   }
   .home-benefits h3 {
   font-size: 1.8em;
   text-align: center;
   margin-bottom: 80px;
   width: 100%;
   }
   @media (min-width: 1300px){
   .container {
   width: 1280px;
   }
   }
</style>
@endsection
@section('content')
<hr class="bread-sep">
<main id="main">
   <div class="container">
      <div class="row">
         <div class="breadcrumbs-wrap">
            <p id="breadcrumbs"><span><span><a href="{{url('/')}}">Home</a></span> <i class="fa fa-angle-right"></i> <span class="breadcrumb_last" aria-current="page">Repair Services</span></span></p>
         </div>
      </div>
   </div>
   <hr class="bread-sep">
   <div class="container">
      <section>
         <div class="services-page-intro">
            <h1>Repair Services</h1>
            <p>At CPR Cell Phone Repair, we understand the crucial role your electronic devices play in day-to-day life. A broken smartphone, tablet, or laptop can put a serious damper on your productivity. Luckily, the experts at CPR are here to save your mobile life with a wide variety of repair services for electronics&nbsp;of all makes and models. Browse our repair services&nbsp;below&nbsp;to find out more about our&nbsp;fast, affordable repair options.</p>
         </div>
      </section>
      <section class="smartphones-repair-services">
         @foreach($data['repair_services'] as $value)
         <div class="repair-half iphone-repair animation-element rps-top-block in-view">
            <a href="javascript:void(0);" title="link to iPhone Repair Services">
            <img src="<?php echo url('public').'/'.$value->image; ?>" alt="iPhone Repair Services">
            </a>
            <h3><a href="javascript:void(0);">{{$value->title}}</a></h3>
               <p>{{Str::words(strip_tags($value->short_description)) }}</p>
               <a href="{{ url('/repair-services/'.$value->type) }}" class="btn blue small radius">Learn More</a>
         </div>
         @endforeach
      </section>
   </div>
   <div class="container">
      <div class="row">
         <div class="col-md-12">
         <section class="inner home-benefits">
         <div class="content_block">
            <h3>Laptop Repair Services in Bolton UK</h3>
            <p>Are you looking for a trusted tire shop in Dubai, UAE? Your search for premium brand tires and top-quality tyres comes to an end. PitStopArabia offers a wide range of high-performance tyres online in Dubai, Abu Dhabi, Sharjah, Ajman, and all across the UAE for our valuable customers. We have a variety of car tyres from well-known and trusted brands such as Bridgestone, Dunlop, Pirelli, Sumitomo, Hankook, and Goodyear, to name a few.</p>
            <p>Each of the tires featured on our website is priced at an affordable rate that no other tire shop in the UAE can match. Our company provides the most premium online tires in Dubai at amazing market competitive prices. Apart from buying online tire products, we also offer auto repair services to ensure our clients have a safe and enjoyable journey.</p>
            <p>PitStopArabia tyre shop in Abu Dhabi, Dubai, and all over the UAE are equipped with the latest technology, manned by seasoned technicians to ensure your vehicle receives the best possible care.</p>
            <p>Hurry up! Find the 70+ certified tire brands in one place and make the best choice for your car at a competitive price. We have car tyres of different tire sizes that suit every customer’s needs. Moreover, the tires can be installed by our certified mechanics at your doorstep on your schedule.<span id="dots" style="display: inline;"> ... <a href="javascript:void(0)" onclick="myFunction()">Read more</a></span></p>
            <span id="more" class="d-none">
               <h2><strong>Find Online Car Tyre Shop Near Me</strong></h2>
               <p>PitStopArabia is the premier online tire shop in Sharjah, Dubai, Abu Dhabi, and UAE. According to vehicle brand, size, and grade, you can easily get the summer, winter, all-season, and all-terrain tires from our vast tire collection in every PitStopArabia service center.</p>
               <ul>
                  <li><a href="javascript:void(0);">Bridgestone</a></li>
                  <li><a href="javascript:void(0);">BFgoodrich</a></li>
                  <li><a href="javascript:void(0);">Continental</a></li>
                  <li><a href="javascript:void(0);">Dunlop</a></li>
                  <li><a href="javascript:void(0);">Goodyear</a></li>
                  <li><a href="javascript:void(0);">Hankook</a></li>
                  <li><a href="javascript:void(0);/">Kumhotyre</a></li>
               </ul>
               <h2><strong>Why Choose PitStopArabia - The Leading Online Tyre Shop UAE</strong></h2>
               <p>PitStopArabia is recognized as one of the leading online tire companies in Dubai, UAE. We do not limit ourselves to super quality tyre sales and its services, such as</p>
               <ul>
                  <li>Tyre Installation</li>
                  <li>Wheel Alignment</li>
                  <li>Tyre Rotation</li>
                  <li>Wheel Balancing</li>
                  <li>Tyre Change</li>
                  <li>Nitrogen Gas Fills</li>
               </ul>
               <p>But we also provide a whole host of other automotive services, which includes:</p>
               <ul>
                  <li>Car Insurance</li>
                  <li>Auto Body Repair</li>
                  <li>Oil Change</li>
                  <li>Oil Filters</li>
                  <li>Window Tinting</li>
                  <li>Battery Check-up</li>
                  <li>Car Paint Protection</li>
                  <li>AC Repair</li>
                  <li>Car Detailing</li>
                  <li>Car Wash</li>
                  <li>Car Brake</li>
               </ul>
               <p>Our car tyre experts are trained to deliver high-quality services and provide expert-level artistry in compliance with the needs and requirements of our customers. At PitStopArabia, customer satisfaction and high quality are at the core of our business model, so that you can count on us.</p>
               <h2><strong>Buy Tires Online UAE - Be Safe With PitStopArabia</strong></h2>
               <p>Our tyre experts help you choose affordable tires for your car and ensure maximum road grip and traction. We strive to provide our customers with convenience and value they cannot find anywhere else. Our product line is extensive, and you can find it all under one roof. So, No need to think twice; PitStopArabia not only resolves your vehicle tire problems but is also a local one-stop for all your car maintenance needs.</p>
               <a href="javascript:void(0)" onclick="myFunction()" id="myBtn">Read less</a>
            </span>
         </div>
      </section>
         </div>
      </div>
  
   </div>
</main>
<br>
@endsection
@section('js')
<!-- <script src="js/custom.js"></script> -->
<script>
   $(document).ready(function() {
   $("#dots a").click(function() {
     $("#more").removeClass("d-none");
     $("#dots").addClass("d-none");
   });
   
   // Show less content when "Read Less" is clicked
   $("#myBtn").click(function() {
     $("#more").addClass("d-none");
     $("#dots").removeClass("d-none");
   });
    });
    </script>
@endsection