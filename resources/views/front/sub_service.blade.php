@extends('front.layouts.master')

@section('css')
   <style>
    p {
        margin-bottom: 0;
    }
    .icon-type-image img{
        text-align: center;
        height: 160px;
    }
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
                            <div class="icon-box-wrapper">
                                <div class="icon-wrapper"> <a class="icon icon-type-image icon-default" href='<?php echo route('brand', ['slug' => $val->slug]); ?>'> <img src="<?php echo url('/public').'/'.$val->image; ?>" alt="Image"> </a></div>
                                <div class="icon-text">
                                    <h6 class="icon-box-title mt-0">{{$val->title}}</h6>
                                    <div class="content">
                                    <div class="tm-sc tm-sc-button mt-2"> 
                                        <a href="<?php echo route('brand', ['slug' => $val->slug]); ?>"  class="btn btn-theme-colored1 btn-sm btn-block">View Detail</a></div>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="btn-view-details mt-0 p-20 bg-theme-colored1"> <a href="<?php echo route('brand', ['slug' => $val->slug]); ?>" class="btn btn-plain-text-with-arrow btn-sm text-white"> View Details </a></div> -->
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