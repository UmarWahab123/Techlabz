@extends('front.layouts.master')

@section('css')
   <style>
    p {
        margin-bottom: 0;
    }
    .nav-link.active{
        background-color: #00c3ed !important;
        color: #fff !important;
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
                        <h2 class="title text-white">{{@$blog_post->title}}</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="">
        <div class="container">
            <div class="section-content">
                <div class="row">
                    <div class="col-12 col-lg-8">
                        <div class="row">
                            <div class="col-xl-12 col-lg-12">
                                <?php echo @$blog_post->description; ?>
                            </div>
                            <div class="col-xl-12 col-lg-12">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <?php if($service->count() > 0) { 
                                    foreach ($service as $key => $val) { ?>
                                        <li class="nav-item" >
                                            <a class="nav-link  border <?php if($key == 0) {echo "active"; } ?>"  data-toggle="tab" href="#<?php echo $val->slug; ?>" role="tab" aria-controls="home" aria-selected="true">{{$val->title}}</a>
                                        </li>
                                    <?php }}?>
                                </ul>
                                <div class="tab-content" id="myTabContent">
                                    <?php if($service->count() > 0) { 
                                    foreach ($service as $key => $val) { ?>
                                    <div class="tab-pane fade <?php if($key == 0) {echo "show active"; } ?>" id="<?php echo $val->slug; ?>" role="tabpanel" aria-labelledby="home-tab"><?php echo $val->description; ?></div>
                                    <?php }}?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4">
                        <div class=" split-nav-menu clearfix widget widget_text">
                            <div class="textwidget">
                                <div class="section-typo-light text-center bg-theme-colored1 mb-md-40 p-30 pt-40 pb-40">
                                    <h4>Contact Us!</h4>
                                    <form class="form form-vertical" id="add_company" method="post">
                                        @csrf
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="mb-1">
                                                <input type="text" name="name" value="" class="form-control"  required placeholder="Name*">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="mb-1">
                                                <input type="email" name="email" value=""  required placeholder="Email*" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="mb-1">
                                                <textarea name="message" cols="40" rows="3" required placeholder="Message*" class="form-control" ></textarea>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary me-1 btn-block waves-effect waves-float waves-light" id="add_company_button">Submit</button>
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
                    url: ajax_url+"/add-service-contact",
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        l.stop();
                        if(response.status) {
                           alert('Message sent successfully! We will contact you shortly!');
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