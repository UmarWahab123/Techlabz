@extends('front.layouts.master')

@section('css')
   <style>
    p {
        margin-bottom: 0;
    }
    .thumb img{
        text-align: center;
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
                        <h2 class="title text-white">Product Detail</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="">
        <div class="container">
            <div class="section-content">
                <div class="row">
                    <div class="col-md-12 col-lg-6">
                        <div class="mb-md-30">
                            <img src="<?php echo url('/public').'/'.$product->image; ?>" alt="">
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-6">
                        <h3 class="name mb-0">{{$product->title}}</h3>
                        <h5 class="text-theme-colored1 mb-30"><i class="fa fa-gbp"></i> <span class="entry-date published updated">{{$product->price}}</span></h5>
                        <p>{{$product->short_description}}</p>
                        <ul class="styled-icons icon-md icon-dark icon-rounded icon-theme-colored1 mt-4">
                            <li><a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo route('product', ['slug' => $product->slug]); ?>" class="social-button " id="" target="_blank"><span class="fa fa-facebook-official"></span></a></li>
                                    <li><a href="https://twitter.com/intent/tweet?text=<?php echo $product->title; ?>&amp;url=<?php echo route('product', ['slug' => $product->slug]); ?>" class="social-button " id="" target="_blank"><span class="fa fa-twitter"></span></a></li>
                                    <li><a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo route('product', ['slug' => $product->slug]); ?>&amp;title=<?php echo $product->title; ?>&amp;summary=<?php echo $product->short_description; ?>" class="social-button " id="" target="_blank"><span class="fa fa-linkedin"></span></a></li>
                                    <li><a href="https://wa.me/?text=<?php echo route('product', ['slug' => $product->slug]); ?>" class="social-button " id="" target="_blank"><span class="fa fa-whatsapp"></span></a></li>
                        </ul>
                        <div class="content">
                            <div class="tm-sc tm-sc-button mt-4"> 
                                <a href="<?php echo route('checkout', ['slug' => $product->slug]); ?>"  class="btn btn-dark btn-sm btn-xs btn-round" rel="noopener noreferrer">Checkout</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <?php echo $product->description; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="elfsight-app-e59ae4d9-89c6-44ce-ade9-93c79cc6198a"></div>
    </section>

    <?php if(!empty($sub_product)) { ?>
        <section class="bg-white-f5">
            <div class="container pt-30 pb-30">
                <div class="section-content">
                    <div class="row justify-content-center">
                        <div class="col-12">
                            <div class="tm-sc tm-sc-section-title section-title section-title-style1 text-center line-bottom-style3-bordered-line">
                                <div class="title-wrapper">
                                    <h2 class="title">RELATED PRODUCTS</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="justify-content-center owl-carousel mt-5">
                    <?php foreach ($sub_product as $key => $val) {  
                        ?>
                        <div class="row ">
                            <div class="col-md-12 col-lg-12 col-xl-12 pb-5">
                                <div class="tm-sc tm-sc-blog tm-sc-blog-masonry blog-style1-current-theme mb-lg-30">
                                    <article class="post type-post status-publish format-standard has-post-thumbnail">
                                        <div class="post-thumb-inner text-center" style="cursor: pointer;"  onclick="window.location.href = '<?php echo route('product-detail', ['slug' => $val->slug]); ?>';">
                                            <div class="thumb p-3"> <img src="<?php echo url('/public').'/'.$val->image; ?>" alt="Image"></div>
                                        </div>
                                        <div class="entry-content text-center pr-1 pl-1 pb-2" style="cursor: pointer;"  onclick="window.location.href = '<?php echo route('product-detail', ['slug' => $val->slug]); ?>';">
                                            <h5 class="entry-title" style="font-weight:500">{{@$val->title}}</h5>
                                            <ul class="entry-meta mb-0 mt-0 pt-0">
                                                <li class="list-inline-item posted-date"> <h5 class="entry-date published updated"><i class="fa fa-gbp"></i>{{$val->price}}</h5></li>
                                            </ul>
                                        </div>
                                    </article>
                                </div>
                            </div>
                        </div>

                    <?php } ?>
                    </div>
                </div>
            </div>
        </section>
    <?php }?>


</div>

@endsection

@section('script-bottom')
<script>

$(document).ready(function(){

$('.owl-carousel').owlCarousel({
        loop: true,
        margin: 10,
        autoplay:true,
        autoplayTimeout:3000,
        autoplayHoverPause:true,
        responsive: {
          0: {
            items: 1,
            nav: true,
            loop: false,
          },
          600: {
            items: 3,
            nav: true,
            loop: false,
          },
          1000: {
            items: 4,
            nav: true,
            margin: 10
          }
        }
      })
    })
</script>
     
@endsection