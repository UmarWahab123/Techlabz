@extends('front.layouts.header')
@section('css')
<style>
    .bread-sep {
    margin-top: 0px;
}
hr {
    /* margin-top: 22px; */
    margin-bottom: 22px;
    border: 0;
    border-top: 1px solid #eee;
}
hr {
    box-sizing: content-box;
    height: 0;
}
.breadcrumbs-wrap p {
    margin: 0px;
    text-transform: uppercase;
    font-size: 12px;
    line-height: 30px;
    font-weight: 300;
}
/*1st section */
.breadcrumbs-wrap {
    position: relative;
    float: left;
    width: 100%;
    min-height: 1px;
    padding-left: 15px;
    padding-right: 15px;
}
a {
    color: #ff5e5b;
    text-decoration: none;
}
meta {
    display: none;
}
.breadcrumbs-wrap p i {
    margin: 0 10px;
}
.fa {
    display: inline-block;
    font: normal normal normal 14px/1 FontAwesome;
    font-size: inherit;
    text-rendering: auto;
    -webkit-font-smoothing: antialiased;
    /* -moz-osx-font-smoothing: grayscale; */
}
a {
    color: #ff5e5b;
    text-decoration: none;
}
/*2nd section*/
.device-repair-top {
    background: #f2f2f2;
    padding-top: 40px;
    margin-bottom: 50px;
    margin-top: -25px;
}
section {
    margin-left: -15px;
    margin-right: -15px;
}
.aligner, .home-ctas .home-cta {
    display: flex;
    align-items: center;
    justify-content: center;
}
@media (min-width: 768px){
.device-repair-top .repair-image {
    float: left;
    width: 41.66667%;
}
}
.device-repair-top .repair-image {
    position: relative;
    min-height: 1px;
    padding-left: 15px;
    padding-right: 15px;
    margin-bottom: -20px;
}
img {
    max-width: 100%;
    height: auto;
}
img {
    /* -webkit-backface-visibility: hidden !important; */
    backface-visibility: hidden !important;
    /* -moz-backface-visibility: hidden !important; */
}
img {
    vertical-align: middle;
}
img {
    border: 0;
}
@media (min-width: 768px){
.device-repair-top .repair-desc {
    float: left;
    width: 58.33333%;
}
}
.device-repair-top .repair-desc {
    position: relative;
    min-height: 1px;
    padding-left: 15px;
    padding-right: 15px;
}
p {
    display: block;
    margin-bottom: 10px;
    font-size: 16px;
    font-weight: 300;
    margin-top: 5px;
    line-height: 1.6em;
}
.devices-list {
    margin-top: 50px;
    display: flex;
    flex-wrap: wrap;
}
.devices-list .brand a {
    color: #1a202a;
}
a {
    font-weight: 500;
}
a {
    background-color: transparent;
}
.devices-list .brand .btn, .devices-list .brand input[type="submit"], .devices-list .brand .advanced-locator button, .advanced-locator .devices-list .brand button {
    color: white;
    font-weight: 800;
    margin-top: 10px;
}
.btn.radius, input.radius[type="submit"], .advanced-locator button.radius {
    border-radius: 5px;
}
.btn.xsmall, input.xsmall[type="submit"], .advanced-locator button.xsmall {
    font-size: 12px;
    padding: 15px 20px;
}
.btn.blue, input.blue[type="submit"], .advanced-locator button {
    background: #02b9f6;
    /* color: white; */
}
.btn, input[type="submit"], .advanced-locator button {
    display: inline-block;
    box-sizing: border-box;
    /* font-weight: 900; */
    text-transform: uppercase;
    max-width: 100%;
    text-align: center;
    letter-spacing: 1px;
    /* padding: 20px 45px;
    font-size: 0.9em; */
}
.devices-list, .brand {
    position: relative;
    min-height: 1px;
    padding-left: 15px;
    padding-right: 15px;
    text-align: center;
    margin-bottom: 80px;
}
section:before, section:after {
    content: " ";
    display: table;
}
.devices-list .brand img {
    max-height: 180px;
    width: auto;
    display: block;
    margin: 0 auto 30px;
}
a img {
    /* -webkit-transition: all ease .4s;
    -moz-transition: all ease .4s;
    -o-transition: all ease .4s;
    -ms-transition: all ease .4s; */
    transition: all ease .4s;
}
.devices-list .brand .brand-name {
    display: block;
}
.container:before, .container:after {
    content: " ";
    display: table;
}
article, aside, details, figcaption, figure, footer, header, hgroup, main, menu, nav, section, summary {
    display: block;
}
* {
    /* -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box; */
    box-sizing: border-box;
}
@media (min-width: 1300px){
.container {
    width: 1280px;
}
}
.container {
    margin-right: auto;
    margin-left: auto;
    padding-left: 15px;
    padding-right: 15px;
}
@media (min-width: 1200px){
.devices-list .brand {
    float: left;
    width: 25%;
}
}
</style>
@endsection
@section('content')
<hr class="bread-sep">
<main id="main">
<div class="container">
      <section>
         <div class="breadcrumbs-wrap">
            <p id="breadcrumbs" itemscope="" itemtype="https://schema.org/BreadcrumbList">
               <span itemprop="itemListElement" itemscope="" itemtype="https://schema.org/ListItem">
                  <span>
                     <a href="{{url('/')}}" itemprop="item">
                        <span itemprop="name">Home</span>
                        <meta itemprop="position" content="1">
                     </a>
                     <i class="fa fa-angle-right"></i>
                     <a href="{{url('/repair-services')}}" itemprop="item">
                        <span itemprop="name">Repair Services</span>
                        <meta itemprop="position" content="2">
                     </a>
                     <i class="fa fa-angle-right"></i>
                     <span class="breadcrumb_last">{{$single_repair_services_category->title}}</span>
                  </span>
               </span>
            </p>
         </div>
      </section>
   </div>
<br>
<br>
   <hr class="bread-sep">
   <div class="device-repair-top">
      <div class="container">
         <section>
            <div class="aligner">
               <div class="repair-image">
                  <img width="1091" height="811" src="<?php echo url('public').'/'.@$single_repair_services_category->image; ?>" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="broken smartphones needing cell phone repair" decoding="async" srcset="<?php echo url('public').'/'.$single_repair_services_category->image; ?>" sizes="(max-width: 1091px) 100vw, 1091px">          
               </div>
               <div class="repair-desc">
                  <h1>{{@$single_repair_services_category->title}}</h1>
                  <p>{{Str::words(strip_tags($single_repair_services_category->short_description)) }}</p>
               </div>
            </div>
         </section>
      </div>
   </div>
   <div class="container">
      <section class="devices-list">
        @foreach($data['total_repair_services_category'] as $value)
         <div class="brand smartphone-brand-iphone">
            <a href="javascript:void(o);">
            <img src="<?php echo url('public').'/'.$value->image; ?>" alt="{{$value->title}}">
            <span class="brand-name">{{$value->title}}</span>
            </a>
            <a class="btn xsmall radius blue" href="{{ route('repair_services_cat_sub_category', ['type' => $value->type, 'slug' => $value->slug,'id' => $value->id]) }}">View Models</a>
         </div>
         @endforeach
      </section>
   </div>
   <hr>
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
<hr class="footer-sep">
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