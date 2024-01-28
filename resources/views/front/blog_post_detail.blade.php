@extends('front.layouts.master')

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
                    <div class="col-sm-9">
                        <article class="post-single">
                            <div class="entry-header mb-30">
                            
                                <div class="post-thumb thumb"> <img class="img-fullwidth" src="<?php echo url('/public').'/'.@$blog_post->image; ?>" alt=""></div>
                            </div>
                            <div class="entry-content">
                                <?php echo @$blog_post->description; ?>
                            </div>
                        </article>
                    </div>
                    <div class="col-lg-3 sidebar-area sidebar-right">
                        <div class="widget widget_categories">
                            <h4 class="widget-title widget-title-line-bottom line-bottom-theme-colored1">Categories</h4>
                            <ul>
                            <?php if($category->count() > 0) { 
                                foreach ($category as $key => $serv) {
                                ?>
                                <li class="cat-item cat-item-16"><a href="<?php echo route('blogpostCategory', ['slug' => $serv->slug]); ?>">{{@$serv->title}}</a></li>
                            <?php } } ?>
                            </ul>
                        </div>
                        <div id="social-links">
                            <h5>Share Post</h5>
                            <ul class="styled-icons icon-md icon-dark icon-rounded icon-theme-colored1">
                                <li><a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo route('blogpostdetail', ['slug' => $blog_post->slug]); ?>" class="social-button " id="" target="_blank"><span class="fa fa-facebook-official"></span></a></li>
                                <li><a href="https://twitter.com/intent/tweet?text=<?php echo $blog_post->title; ?>&amp;url=<?php echo route('blogpostdetail', ['slug' => $blog_post->slug]); ?>" class="social-button " id="" target="_blank"><span class="fa fa-twitter"></span></a></li>
                                <li><a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo route('blogpostdetail', ['slug' => $blog_post->slug]); ?>&amp;title=<?php echo $blog_post->title; ?>&amp;summary=<?php echo $blog_post->short_description; ?>" class="social-button " id="" target="_blank"><span class="fa fa-linkedin"></span></a></li>
                                <li><a href="https://wa.me/?text=<?php echo route('blogpostdetail', ['slug' => $blog_post->slug]); ?>" class="social-button " id="" target="_blank"><span class="fa fa-whatsapp"></span></a></li>    
                            </ul>
                        </div>
                        <div id="social-links">
                            <h5>Contact Us</h5>
                        </div>
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

                        <div class="widget widget_categories">
                            <h4 class="widget-title widget-title-line-bottom line-bottom-theme-colored1">Related Posts</h4>
                            <ul>
                            <?php if($related_post->count() > 0) { 
                                foreach ($related_post as $key => $serv) {
                                ?>
                                <li class="cat-item cat-item-16"><a href="<?php echo route('blogpostCategory', ['slug' => $serv->slug]); ?>">{{@$serv->title}}</a></li>
                            <?php } } ?>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection

@section('script-bottom')

     
@endsection