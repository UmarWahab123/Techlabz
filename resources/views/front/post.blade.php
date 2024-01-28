@extends('front.layouts.header')

@section('css')
   <style>
    .custom-style-read-more-btn{
        color:deepskyblue;
    }
    .blog-post-title a{
        color:black;
    }
    .common-heads-style{
        color:black;
    }
    </style>
@endsection
@section('content')
<div class="main-content-area">
    <!-- Section: News & Updates-->
    <section>
        <div class="container pt-90" >
            <div class="section-title common-header-section mt-2">
                <div class="row justify-content-md-center">
                    <div class="col-md-8">
                        <div class="text-center mb-60">
                            <div class="tm-sc tm-sc-section-title section-title section-title-style1 text-center line-bottom-style4-attached-double-lines1">
                                <div class="title-wrapper">
                                    <h2 class="title mb-5 mt-5 font-weight-bold common-head-style"> <span class="">Our Blog</span> Posts</h2>
                                    <div class="title-seperator-line"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="section-content ml-5 mt-5">
                <div class="row">
                    <div class="col-sm-9">
                    <ul class="list-group blog_list">
                    <?php if($blog_post->count() > 0) { 
                        foreach ($blog_post as $blog) {
                        ?>
                            <li class="list-group-item product-box">
                            <!-- Custom content-->
                            <div class="media align-items-lg-center flex-column flex-lg-row">
                                <div>
                                    <img src="<?php echo url('/public').'/'.@$blog->image; ?>" alt="Generic placeholder image" width="200" class="ml-lg-1 order-1 order-lg-2">
                                </div>
                                <div class="media-body order-2 order-lg-4 ml-4">
                                    <h5 class="mt-0 font-weight-bold mb-2 blog-post-title"><a href="<?php echo route('post', ['slug' => $blog->slug]); ?>">{{@$blog->title}}</a></h5>
                                    <p class="font-italic text-muted mb-0 small">{{@$blog->short_description}}</p>
                                    <div class="footer-social">
                                    <div class="d-flex align-items-center justify-content-between mt-3">
                                        <ul class="styled-icons icon-md icon-dark icon-rounded icon-theme-colored1">
                                        <li><a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo route('post', ['slug' => $blog->slug]); ?>" class="social-button " id="" target="_blank"><span class="fa fa-facebook-official"></span></a></li>
                                        <li><a href="https://twitter.com/intent/tweet?text=<?php echo $blog->title; ?>&amp;url=<?php echo route('post', ['slug' => $blog->slug]); ?>" class="social-button " id=""  target="_blank"><span class="fa fa-twitter"></span></a></li>
                                        <li><a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo route('post', ['slug' => $blog->slug]); ?>&amp;title=<?php echo $blog->title; ?>&amp;summary=<?php echo $blog->short_description; ?>" class="social-button " id=""  target="_blank"><span class="fa fa-linkedin"></span></a></li>
                                        <li><a href="https://wa.me/?text=<?php echo route('post', ['slug' => $blog->slug]); ?>" class="social-button " id=""  target="_blank"><span class="fa fa-whatsapp"></span></a></li> 
                                        </ul>
                                        <div class=" split-nav-menu clearfix widget-brochure-box clearfix"><a class="tm-widget tm-widget-brochure-box tm-widget-brochure-box-default brochure-box brochure-box-default  brochure-box-theme-colored1" href="<?php echo route('post', ['slug' => $blog->slug]); ?>"> 
                                        <h5 class="text custom-style-read-more-btn">Read More</h5>
                                        </a></div>
                                    </div>
                                </div>
                            </div> <!-- End -->
                        </li> <!-- End -->
                    <?php } } ?>
                    </ul>
                        <div class="col-12 mt-2">
                            {!! $blog_post->links() !!}
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="widget widget_categories">
                            <h4 class="widget-title widget-title-line-bottom line-bottom-theme-colored1 common-heads-style">Categories</h4>
                            <ul>
                            <?php if($category->count() > 0) { 
                                foreach ($category as $key => $serv) {
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

@section('js')

     
@endsection