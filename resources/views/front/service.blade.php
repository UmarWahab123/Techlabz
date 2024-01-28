@extends('front.layouts.header')

@section('css')
   <style>
    p {
        margin-bottom: 0;
    }
    .icon-type-image img{
        text-align: center;
        height: 180px;
    }
    /* .icon-box.iconbox-style7-hover-moving-border {
        overflow: hidden;
    }
    .bg-white {
        background-color: #fff !important;
    }
    .icon-box {
        position: relative;
        z-index: 0;
        transition: all 0.3s ease;
    }
    .icon-box.iconbox-style7-hover-moving-border:before {
        border-top-color: rgba(0, 195, 237, 0.7);
        border-bottom-color: rgba(0, 195, 237, 0.7);
    }
    .icon-box.iconbox-style7-hover-moving-border:before {
        /* -webkit-transform: scale(0, 1); */
        transform: scale(0, 1);
    }
    .icon-box.iconbox-style7-hover-moving-border:before {
        border-top: 2px solid #444;
        border-bottom: 2px solid #444;
    }
    .icon-box.iconbox-style7-hover-moving-border:after, .icon-box.iconbox-style7-hover-moving-border:before {
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        content: '';
        opacity: 0;
        /* -webkit-transition: opacity 0.55s,-webkit-transform 0.55s; */
        transition: opacity 0.55s,transform 0.55s;
        z-index: -1;
    }
    .icon-box.iconbox-default-padding .icon-box-wrapper {
        padding: 50px 35px 50px 35px;
    }
    .icon-box .icon-wrapper {
        margin-bottom: 20px;
    }
    .icon-box.text-center .icon.icon-type-image {
        text-align: center;
        display: inline-block;
    }
    .icon-box .icon.icon-default {
        height: auto;
        width: auto;
        margin-bottom: 5px;
    }
    .icon-box .icon {
        /* display: inline-block; */
        /* height: 70px; */
        /* margin-bottom: 15px; */
        transition: all 0.3s ease;
        /* width: 70px; */
        /* text-align: center; */
        font-weight: normal;
    }
    html, html a {
        -webkit-font-smoothing: antialiased;
    }
    a {
        /* color: #0073aa; */
        text-decoration: none;
        /* font-weight: 600; */
        /* transition: all 0.3s ease; */
    }
    .icon-type-image img {
        text-align: center;
        height: 180px;
    }
    a img {
        border: none;
    }
    img {
        /* height: auto; */
        max-width: 100%;
    }
    .icon-box .icon-box-title, .icon-box .icon-box-title a {
        transition: all 0.1s ease;
    }
    .btn-group-sm > .btn, .btn-sm {
        padding: 0.5rem 1.5rem;
    }
    .btn {
        border-width: 3px;
        letter-spacing: .05rem;
        padding: 0.8rem 2.5rem;
        overflow: hidden;
    }
    .icon-box.iconbox-style7-hover-moving-border:before {
    border-top-color: rgba(0, 195, 237, 0.7) !important;
    border-bottom-color: rgba(0, 195, 237, 0.7) !important;
} */
   </style>
@endsection
@section('content')

<div class="main-content-area">
    <!-- Section: inner-header -->
    <section class="page-title divider layer-overlay overlay-dark-8 section-typo-light bg-img-center">
        <div class="container pt-90 pb-90">
            <!-- Section Content -->
            <div class="section-content">
                <div class="row ">
                    <div class="col-md-12 text-center">
                        <h2 class="title text-white">Services</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="">
        <div class="container">
            <div class="section-content">
                <div class="row justify-content-center">

                <?php if($service->count() > 0) { 
                    foreach ($service as $key => $val) {
                        
                    ?>
                    <div class="col-md-6 col-lg-6 col-xl-3 pb-5">
                        <div class="tm-sc tm-sc-icon-box icon-box icon-top tm-iconbox-icontype-font-icon text-center iconbox-style7-hover-moving-border bg-white iconbox-box-shadow  iconbox-theme-colored1 iconbox-default-padding icon-position-icon-top mb-lg-50" style="box-shadow: 0px 0px 50px  rgb(5 5 5 / 15%);">
                            <?php if($val->slug == 'laptops' || $val->slug == 'laptop') { ?>
                            <div class="icon-box-wrapper">
                                <div class="icon-wrapper"> 
                                    <a class="icon icon-type-image icon-default" href='<?php echo route('brand', ['slug' => $val->slug]); ?>'> <img src="<?php echo url('/public').'/'.$val->image; ?>" alt="Image"> </a>
                                </div>
                                <div class="icon-text">
                                    <p class="icon-box-title mt-0">{{$val->title}}</p>
                                    <div class="content">
                                    <div class="tm-sc tm-sc-button mt-2"> 
                                        <a href="<?php echo route('brand', ['slug' => $val->slug]); ?>"  class="btn btn-theme-colored1 btn-sm btn-block">View Detail</a></div>
                                    </div>
                                </div>
                            </div>
                            <?php } else {?>
                                <div class="icon-box-wrapper">
                                    <div class="icon-wrapper"> 
                                        <a class="icon icon-type-image icon-default" href='<?php echo route('service', ['slug' => $val->slug]); ?>'> <img src="<?php echo url('/public').'/'.$val->image; ?>" alt="Image"> </a>
                                    </div>
                                    <div class="icon-text">
                                        <h6 class="icon-box-title mt-0">{{$val->title}}</h6>
                                        <div class="content">
                                            <div class="tm-sc tm-sc-button mt-2"> 
                                                <a href="<?php echo route('service', ['slug' => $val->slug]); ?>"  class="btn btn-theme-colored1 btn-sm btn-block">View Detail</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php }?>
                            <!-- <div class="btn-view-details mt-0 p-20 bg-theme-colored1"> <a href="<?php echo route('service', ['slug' => $val->slug]); ?>" class="btn btn-plain-text-with-arrow btn-sm text-white"> View Details </a></div> -->
                        </div>
                    </div>

                <?php } } ?>
                </div>
            </div>
        </div>
    </section>

</div>

@endsection

@section('script-bottom')

     
@endsection