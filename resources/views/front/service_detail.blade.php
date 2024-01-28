@extends('front.layouts.master')

@section('css')
   <style>
    p {
        margin-bottom: 0;
    }

    .sidebar-item {
	position: absolute;
	top: 0;
	left: 0;
	width: 100%;
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
                        <h2 class="title text-white">{{@$blog_post->title}}</h2>
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
                    <div class="col-12 col-lg-8">
                        <article class="post-single">
                            <div class="entry-content">
                                <?php echo @$blog_post->description; ?>
                            </div>
                        </article>
                    </div>
                    <div class="col-12 col-lg-4">
                        <div class=" sidebar-item">
                            <div class="row pr-3 pl-3">
                                <div class="col-md-12 col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title">Contact Us</h4>
                                        </div>
                                        <div class="card-body">
                                            <form class="form form-vertical" id="add_company" method="post">
                                            @csrf
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="mb-2">
                                                            <label class="form-label" for="first-name-vertical">Name</label>
                                                            <input type="text" name="name" value="" class="form-control" id="first-name-vertical" required placeholder="Name*">
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="mb-2">
                                                            <label class="form-label" for="email-id-vertical">Email</label>
                                                            <input type="email" name="email" value="" id="email-id-vertical" required placeholder="Email*" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="contact-info-vertical">Mobile</label>
                                                            <textarea name="message" cols="40" id="contact-info-vertical" rows="3" required placeholder="Message*" class="form-control" ></textarea>
                                                    
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <button type="submit" class="btn btn-primary btn-sm me-1 waves-effect waves-float waves-light" id="add_company_button">Submit</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class=" make-me-sticky">
                                <div class="widget widget_categories mb-md-40 p-30 pt-40 pb-40">
                                    <h4 class="widget-title widget-title-line-bottom line-bottom-theme-colored1">Repair Services</h4>
                                    <ul>
                                        <?php if($repair_service->count() > 0) { 
                                        foreach ($repair_service as $key => $val) {
                                        ?>
                                        <li class="cat-item cat-item-16"><a href="<?php echo route('service', ['slug' => $val->slug]); ?>">{{$val->title}}</a></li>
                                        <?php } }?>
                                    </ul>
                                </div>
                                <div class="widget widget_categories mb-md-40 p-30 pt-0 pb-40">
                                    <h4 class="widget-title widget-title-line-bottom line-bottom-theme-colored1">Mini PCs Sale</h4>
                                    <ul>
                                    <?php if($brnd->count() > 0) { 
                                        foreach ($brnd as $key => $vali) {
                                        ?>
                                        <li class="cat-item cat-item-16"><a href="<?php echo route('product', ['brand' => $vali->slug,'slug' => 'mini-pc']); ?>">{{$vali->title}} Mini-Micro PCs</a></li>
                                    <?php } }?>
                                    </ul>
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
                           
                           toastr.success("We Have recieved your message! We will contact you shortly!", '', {
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