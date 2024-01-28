@extends('front.layouts.master')

@section('css')
   <style>
    p {
        margin-bottom: 0;
    }
    .thumb img{
        text-align: center;
        height: 180px;
    }
    .main-content-area article .post-excerpt .mascot-post-excerpt {
        font-size: 0.97rem;
    }
    .tm-sc-blog.blog-style1-current-theme article .entry-content .entry-meta {
        font-size: 28px;
        margin-bottom: 0px;
        padding-top: 0px;
        margin-top: 0px;
    }
    .tm-sc-blog.blog-style1-current-theme article .entry-content{
        padding: 20px 30px 30px 30px;
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
                        <h2 class="title text-white">Product</h2>
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
                        <div class="tm-sc tm-sc-blog tm-sc-blog-masonry blog-style1-current-theme mb-lg-30">
                            <article class="post type-post status-publish format-standard has-post-thumbnail">
                                <a class="post-thumb-inner text-center" href="<?php echo route('product-detail', ['slug' => $val->slug]); ?>">
                                    <div class="thumb p-3"> <img src="<?php echo url('/public').'/'.$val->image; ?>" alt="Image"></div>
                                </a>
                                <div class="entry-content text-center">
                                    <h6 class=""><a href="<?php echo route('product-detail', ['slug' => $val->slug]); ?>">{{@$val->title}}</a></h6>
                                    <h5 class="text-theme-colored1"><a href="<?php echo route('product-detail', ['slug' => $val->slug]); ?>"><i class="fa fa-gbp"></i> {{$val->price}}</a></h5>
                                    <div class="content">
                                        <div class="tm-sc tm-sc-button mt-2 text-center"> 
                                            <a href="<?php echo route('product-detail', ['slug' => $val->slug]); ?>"  class="btn btn-theme-colored1 btn-sm btn-block">View Detail</a>
                                        </div>
                                    </div>
                                </div>
                            </article>
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