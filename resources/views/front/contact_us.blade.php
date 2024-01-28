@extends('front.layouts.header')


@section('css')
   <style>
    p {
        margin-bottom: 0;
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
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h2 class="title text-white">Contact Us</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Blog -->
    <section>
        <div class="container pb-60">
            <div class="section-content">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-12 col-lg-3">
                                <div class=" split-nav-menu clearfix widget widget_text">
                                    <div class="textwidget">
                                        <div class="section-typo-light text-center bg-theme-colored1 mb-md-40 p-30 pt-40 pb-40">
                                            <p>
                                                <i class="fa fa-phone-square fa-3x" aria-hidden="true"></i>
                                            </p>
                                            <h4>Call Us</h4>
                                            <h5><a href="tel:<?php echo $setting->phone; ?>" class="btn btn-dark btn-sm btn-xs btn-round">{{@$setting->phone}}</a></h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-3">
                                <div class=" split-nav-menu clearfix widget widget_text">
                                    <div class="textwidget">
                                        <div class="section-typo-light text-center bg-theme-colored1 mb-md-40 p-30 pt-40 pb-40">
                                            <p>
                                                <i class="fa fa-envelope fa-3x" aria-hidden="true"></i>
                                            </p>
                                            <h4>Email</h4>
                                            <h5><a href="mailto:<?php echo $setting->email; ?>" class="btn btn-dark btn-sm btn-xs btn-round">{{@$setting->email}}</a></h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-3">
                                <div class=" split-nav-menu clearfix widget widget_text">
                                    <div class="textwidget">
                                        <div class="section-typo-light text-center bg-theme-colored1 mb-md-40 p-30 pt-40 pb-40">
                                            <p>
                                                <i class="fa fa-whatsapp fa-3x" aria-hidden="true"></i>
                                            </p>
                                            <h4>WhatsApp</h4>
                                            <h5><a href="https://api.whatsapp.com/send?phone=443337729109" target="_blank" class="btn btn-dark btn-sm btn-xs btn-round">{{@$setting->phone}}</a></h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-3">
                                <div class=" split-nav-menu clearfix widget widget_text">
                                    <div class="textwidget">
                                        <div class="section-typo-light text-center bg-theme-colored1 mb-md-40 p-30 pt-40 pb-40">
                                            <p>
                                                <i class="fa fa-map-marker fa-3x" aria-hidden="true"></i>
                                            </p>
                                            <h4>Address</h4>
                                            <h5><a href="http://maps.google.com/?q=<?php echo $setting->address; ?>" target="_blank" class="btn btn-dark btn-sm btn-xs btn-round">Our Location</a></h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="tm-sc tm-sc-custom-columns-holder tm-cc-two-columns tm-cc-responsive-mode-1280">
                                    <div class="tm-sc tm-sc-custom-columns-holder-item  section-typo-light bg-theme-colored1" data-item-class="econsul-mascot-custom-columns-924797" data-tm-bg-img="images/bg/worldmap.png" data-1200-up="80px 15% 100px 10%" data-1199-down="80px 10% 100px 10%" >
                                        <div class="item-inner">
                                            <div class="item-content econsul-mascot-custom-columns-924797 p-5">
                                                <div class="text-center">
                                                    <h2>How can we help you? </h2>
                                                <div>
                                                <div role="form" class="wpcf7" id="wpcf7-f452-p311-o1" lang="en-US" dir="ltr">
                                                    <div class="screen-reader-response"></div>
                                                    <form  class="wpcf7-form" id="add_company" method="post" >
                                                        @csrf
                                                        <div class="tm-contact-form-transparent pr-0">
                                                            <div class="row">
                                                                <div class="col-md-6"> <span class="wpcf7-form-control-wrap your-name"><input type="text" name="name" value=""  required placeholder="Name*"></span></div>
                                                                <div class="col-md-6"> <span class="wpcf7-form-control-wrap your-email"><input type="email" name="email" value=""  required placeholder="Email*"></span></div>
                                                                <div class="col-md-12"> <span class="wpcf7-form-control-wrap textarea"><textarea name="message" cols="40" rows="3" required placeholder="Message*" ></textarea></span></div>
                                                                <div class="col-md-12"> <input type="submit" value="Submit Now" class="wpcf7-form-control wpcf7-submit btn btn-theme-colored2 btn-round" id="add_company_button"></div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection

@section('script-bottom')

<script>

$(function() {
        $("#add_company").validate({
            submitHandler: function() {
                var l = Ladda.create(document.querySelector('#add_company_button'));
                l.start();
                var formData = new FormData($('#add_company')[0]);
                $.ajax({
                    data: formData,
                    type: "POST",
                    url: ajax_url+"/add-contact-us",
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        l.stop();
                        if(response.status) {
                           
                           toastr.success("Message sent successfully! We will contact you shortly!", '', {
                                "progressBar": true,
                                "positionClass": "toast-top-center",
                                "showDuration": "10000",
  "hideDuration": "10000",
  "timeOut": "10000",
  "extendedTimeOut": "10000",
                            });
                            $('#add_company').trigger("reset");
                        //    window.location.href = ajax_url+"/contact-us";

                        } else {
                            toastr.error('Something went wrong!', '', {
                                "progressBar": true,
                                "positionClass": "toast-top-center",

                                "showDuration": "10000",
  "hideDuration": "10000",
  "timeOut": "10000",
  "extendedTimeOut": "10000",
                            });
                        }
                        
                    },
                    error: function(response) {
                        l.stop();
                        toastr.error('Something went wrong!', '', {
                            "progressBar": true,
                            "positionClass": "toast-top-center",
                            "showDuration": "10000",
  "hideDuration": "10000",
  "timeOut": "10000",
  "extendedTimeOut": "10000",
                        });
                    }
                });
            }
        });
    });
</script>

@endsection