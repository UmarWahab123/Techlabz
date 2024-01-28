@extends('front.layouts.header')
@section('css')
<style>
  .bread-sep {
    margin-top: 0px;
}
article, aside, details, figcaption, figure, footer, header, hgroup, main, menu, nav, section, summary {
    display: block;
}
@media (min-width: 1300px){
.container {
    width: 1280px;
}
}
.container:before, .container:after {
    content: " ";
    display: table;
}
section {
    margin-left: -15px;
    margin-right: -15px;
}
article, aside, details, figcaption, figure, footer, header, hgroup, main, menu, nav, section, summary {
    display: block;
}
section:before, section:after {
    content: " ";
    display: table;
}
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
p {
    display: block;
}
.breadcrumbs-wrap p {
    margin: 0px;
    text-transform: uppercase;
    font-size: 12px;
    line-height: 30px;
    font-weight: 300;
}
a {

    transition: all ease .4s;
    color: #ff5e5b;
    text-decoration: none;
}
a {
    font-weight: 500;
}
a {
    background-color: transparent;
}
.fa {
    display: inline-block;
    font: normal normal normal 14px/1 FontAwesome;
    font-size: inherit;
    text-rendering: auto;
    -webkit-font-smoothing: antialiased;
    /* -moz-osx-font-smoothing: grayscale; */
}
.breadcrumbs-wrap p i {
    margin: 0 10px;
}
.fa-angle-right:before {
    content: "\f105";
}
* {

    box-sizing: border-box;
}
meta {
    display: none;
}
.breadcrumbs-wrap p i {
    margin: 0 10px;
}
section:after {
    clear: both;
}
.container:after {
    clear: both;
}
.container:before, .container:after {
    content: " ";
    display: table;
}
hr {
    margin-top: 22px;
    margin-bottom: 22px;
    border: 0;
    border-top: 1px solid #eee;
}
hr {
    box-sizing: content-box;
    height: 0;
}
.intro-wrapper {
    background: #f7f7f7;
    padding: 50px 0;
    margin-top: -25px;
}
.intro-wrapper .product-head.in-view {

    transition: all 1s ease;
    opacity: 1;
}
.intro-wrapper .product-head {
    position: relative;
    float: left;
    width: 100%;
    min-height: 1px;
    padding-left: 15px;
    padding-right: 15px;
    /* opacity: 0; */
}
h1, h2, h3, h4, h5, h6 {
    font-weight: 800;
    margin-top: 0px;
    margin-bottom: 0px;
}
h1 {
    font-size: 1.6em;
}
h1 {
    /* font-size: 2em; */
    margin: 0.67em 0;
}
.intro-wrapper .product-head p {
    font-size: 0.9em;
}
p {
    display: block;
    margin-bottom: 10px;
    /* font-size: 16px; */
    font-weight: 300;
    margin-top: 5px;
    line-height: 1.6em;
}
.intro-wrapper .product-head p {
    font-size: 0.9em;
}
.top-ctas-wrapper {
    overflow: hidden;
}
.aligner, .home-ctas .home-cta {
    display: flex;
    align-items: center;
    justify-content: center;
}
@media (min-width: 992px){
.product-warranty .block-image {
    float: left;
    width: 33.33333%;
}}
.product-warranty .block-image {
    position: relative;
    min-height: 1px;
    padding-left: 15px;
    padding-right: 15px;
}
.product-warranty .block-image img {
    max-width: 120px;
    margin: 0 15px;
}
img {
    /* max-width: 100%; */
    height: auto;
}
img {
    /* -webkit-backface-visibility: hidden !important; */
    backface-visibility: hidden !important;
    
    vertical-align: middle;
    border: 0;
    /* -moz-backface-visibility: hidden !important; */
}
@media (min-width: 992px){
.product-warranty .block-content {
    float: left;
    width: 66.66667%;
}
}
.product-warranty .block-content {
    position: relative;
    min-height: 1px;
    padding-left: 15px;
    padding-right: 15px;
}
.product-warranty .block-content span {
    display: block;
    color: white;
    font-size: 1.2em;
    letter-spacing: 1px;
    font-weight: 800;
}
img, .smartphones-repair-services .repair-half.iphone-repair.in-view img, .smartphones-repair-services .repair-half.smartphone-repair.in-view img, .other-devices .device-block-repair .image-wrapper.in-view img, .devices .device-repair-block.in-view {
    /* -moz-transform: translate(0px, 0px);
    -webkit-transform: translate(0px, 0px);
    -o-transform: translate(0px, 0px);
    -ms-transform: translate(0px, 0px); */
    transform: translate(0px, 0px);
}
@media (min-width: 992px){
  .locator-call {
    float: left;
    width: 48.33333%;
}
}
.locator-call {
    /* position: relative;
    min-height: 1px;
    padding-left: 15px;
    padding-right: 15px; */
    position: relative;
    min-height: 1px;
    padding-left: 15px;
    padding-right: 15px;
    overflow: hidden;
    margin: 30px 0 0 30px;
    background: #02b9f6;
    /* transform: translate(200%, 0); */
}
.aligner, .home-ctas .home-cta {
    display: flex;
    align-items: center;
    justify-content: center;
}
@media (min-width: 992px){
  .locator-call .block-image {
    float: left;
    width: 33.33333%;
}
}
.locator-call .block-image {
    position: relative;
    min-height: 1px;
    padding-left: 15px;
    padding-right: 15px;
    padding: 10px 0;
}
.locator-call .block-image img {
    width: 80px;
    margin-bottom: -36px !important;
}
@media (max-width: 1500px){
  .block-image img {
    margin: 0;
}
}
img {
    max-width: 100%;
    height: auto;
}

element.style {
}
.locator-call .block-image img {
    width: 80px;
    margin-bottom: -36px !important;
}
@media (max-width: 1500px){
.block-image img {
    margin: 0;
}
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
@media (min-width: 992px){
.locator-call .block-content {
    float: left;
    width: 66.66667%;
}
}
.locator-call .block-content {
    position: relative;
    min-height: 1px;
    padding-left: 15px;
    padding-right: 15px;
}
.locator-call .block-content span {
    display: block;
    color: white;
    font-size: 1.2em;
    letter-spacing: 1px;
    font-weight: 800;
}
.locator-call .block-content a {
    color: #b5e1f9;
    font-size: 0.9em;
    letter-spacing: 1.5px;
    font-weight: 500;
    display: block;
}
.fa {
    display: inline-block;
    font: normal normal normal 14px/1 FontAwesome;
    font-size: inherit;
    text-rendering: auto;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}
.prod-info-block {
    margin: 60px -15px 80px -15px;
}
article, aside, details, figcaption, figure, footer, header, hgroup, main, menu, nav, section, summary {
    display: block;
}
.prod-image.in-view {
    /* -moz-transition: all 2s ease;
    -webkit-transition: all 2s ease;
    -ms-transition: all 2s ease;
    -o-transition: all 2s ease; */
    transition: all 2s ease;
    opacity: 1;
}
.prod-image.in-view img {
    /* -moz-transition: all 1.3s ease;
    -webkit-transition: all 1.3s ease;
    -ms-transition: all 1.3s ease;
    -o-transition: all 1.3s ease; */
    transition: all 1.3s ease;
}
@media (min-width: 992px){
.service-desc {
    float: left;
    width: 66.66667%;
}
}
.service-desc {
    /* position: relative;
    min-height: 1px;
    padding-left: 15px;
    padding-right: 15px; */
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
p {
    /* display: block; */
    margin-block-start: 1em;
    margin-block-end: 1em;
    margin-inline-start: 0px;
    margin-inline-end: 0px;
}
h1, h2, h3, h4, h5, h6 {
    font-weight: 800;
    margin-top: 0px;
    margin-bottom: 0px;
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
                     <a href="{{ url('/repair-services/' . $repair_services_cat_details->type) }}" itemprop="item">
                        <span itemprop="name">{{ $repair_services_cat_details->type }}</span>
                        <meta itemprop="position" content="3">
                    </a>
                     <i class="fa fa-angle-right"></i>
                     <span class="breadcrumb_last">{{ $repair_services_cat_details->title }}</span>
                  </span>
               </span>
            </p>
         </div>
      </section>
   </div>
   <hr>
   <div class="intro-wrapper">
      <div class="container">
         <section>
            <div class="product-head animation-element in-view">
               <h1>{{@$repair_services_cat_details->title}}</h1>
               <p></p>
               <p>{{Str::words(strip_tags(@$repair_services_cat_details->short_description)) }}</p>
               <p></p>
            </div>
         </section>
      </div>
   </div>
   <!-- <div class="top-ctas-wrapper">
      <div class="container">
         <section>
            <div class="product-warranty animation-element in-view">
               <section>
                  <div class="aligner">
                     <div class="block-image">
                        <img src="https://images.cellphonerepair.com/wp-content/themes/cpr-main/images/warranty.svg" alt="Limited Lifetime Warranty seal">
                     </div>
                     <div class="block-content">
                        <span>LIMITED LIFETIME WARRANTY</span>
                     </div>
                  </div>
               </section>
            </div>
            <div class="locator-call animation-element in-view">
               <section>
                  <div class="aligner">
                     <div class="block-image">
                        <img src="https://images.cellphonerepair.com/wp-content/themes/cpr-main/images/map-marker-white.svg" alt="decorative map pin">
                     </div>
                     <div class="block-content">
                        <span>GET IT FIXED FAST!</span>
                        <a href="https://www.cellphonerepair.com/locations/">FIND YOUR LOCAL CPR <i class="fa fa-arrow-right"></i></a>
                     </div>
                  </div>
               </section>
            </div>
         </section>
      </div>
   </div> -->
   <div class="container mt-4">
   <!-- <section class="prod-info-block"> -->
    <div class="row">
      <div class="col-md-4">
      <div class="prod-image animation-element mt-5 in-view">
            <img src="<?php echo url('public').'/'.@$repair_services_cat_details->image; ?>" style="width:100%;" alt="broken hp computer">
         </div>
      </div>
      <div class="col-md-8">
            <p>{{Str::words(strip_tags(@$repair_services_cat_details->description),200) }}</p>
         </div>
      </div>
    </div>
    <!-- </section> -->
   </div>
</main>
<hr>
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