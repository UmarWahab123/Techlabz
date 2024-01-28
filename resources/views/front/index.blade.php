@extends('front.layouts.master')

@section('css')
   <style>
    .thumb img {
        height: 200px !important;
    }

   </style>
   
@endsection
@section('content')

<div class="main-content-area">
    <!-- Section: home -->
    <section id="home" class="">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col">
                    <!-- START Home Slider REVOLUTION SLIDER 6.0.8 -->
                    <p class="rs-p-wp-fix"></p>
                    <rs-module-wrap id="rev_slider_1_1_wrapper" data-alias="home-slider" data-source="gallery" style="background:transparent;padding:0;margin:0px auto;margin-top:0;margin-bottom:0;">
                        <rs-module id="rev_slider_1_1" style="display:none;" data-version="6.0.8">
                            <rs-slides>
                                <rs-slide data-key="rs-1" data-title="Slide 1" data-thumb="<?php echo url('/public').'/'.@$setting->image; ?>" data-anim="ei:d;eo:d;s:d;r:0;t:slotslide-horizontal;sl:d;">
                                    <img src="<?php echo url('/public').'/'.@$setting->image; ?>" title="s6.jpg" width="500" height="200" data-bg="p:center center;" data-parallax="off" class="rev-slidebg" data-no-retina="">
                                    <rs-layer id="slider-1-slide-1-layer-19" class="rs-pxl-1" data-type="text" data-rsp_ch="on" data-xy="x:l,l,l,c;xo:50px,50px,35px,2px;yo:280px,291px,202px,208px;" data-text="w:normal;s:85,76,75,56;l:100,90,90,70;fw:700;a:left,left,left,center;" data-dim="w:724px,644px,653px,476px;" data-frame_0="x:-50,-38,-28,-17;" data-frame_1="st:1700;sp:1000;" data-frame_999="x:-50,-38,-28,-17;o:0;st:w;sp:1000;" style="z-index:12;font-family:Poppins;">{{$setting->slider_text}}
                                    </rs-layer>
                                    
                                </rs-slide>
                            

                        <?php if(!empty($setting->image_2)) { ?>

                            
                                <rs-slide data-key="rs-2" data-title="Slide 2" data-thumb="<?php echo url('/public').'/'.@$setting->image_2; ?>" data-anim="ei:d;eo:d;s:d;r:0;t:slotslide-horizontal;sl:d;">
                                    <img src="<?php echo url('/public').'/'.@$setting->image_2; ?>" title="s6.jpg" width="500" height="200" data-bg="p:center center;" data-parallax="off" class="rev-slidebg" data-no-retina="">
                                    <rs-layer id="slider-1-slide-1-layer-19" class="rs-pxl-1" data-type="text" data-rsp_ch="on" data-xy="x:l,l,l,c;xo:50px,50px,35px,2px;yo:280px,291px,202px,208px;" data-text="w:normal;s:85,76,75,56;l:100,90,90,70;fw:700;a:left,left,left,center;" data-dim="w:724px,644px,653px,476px;" data-frame_0="x:-50,-38,-28,-17;" data-frame_1="st:1700;sp:1000;" data-frame_999="x:-50,-38,-28,-17;o:0;st:w;sp:1000;" style="z-index:12;font-family:Poppins;">{{$setting->slider_text_2}}
                                    </rs-layer>
                                    
                                </rs-slide>
                           

                        <?php }?>

                        <?php if(!empty($setting->image_3)) { ?>

                                <rs-slide data-key="rs-3" data-title="Slide 3" data-thumb="<?php echo url('/public').'/'.@$setting->image_3; ?>" data-anim="ei:d;eo:d;s:d;r:0;t:slotslide-horizontal;sl:d;">
                                    <img src="<?php echo url('/public').'/'.@$setting->image_3; ?>" title="s6.jpg" width="500" height="200" data-bg="p:center center;" data-parallax="off" class="rev-slidebg" data-no-retina="">
                                    <rs-layer id="slider-1-slide-1-layer-19" class="rs-pxl-1" data-type="text" data-rsp_ch="on" data-xy="x:l,l,l,c;xo:50px,50px,35px,2px;yo:280px,291px,202px,208px;" data-text="w:normal;s:85,76,75,56;l:100,90,90,70;fw:700;a:left,left,left,center;" data-dim="w:724px,644px,653px,476px;" data-frame_0="x:-50,-38,-28,-17;" data-frame_1="st:1700;sp:1000;" data-frame_999="x:-50,-38,-28,-17;o:0;st:w;sp:1000;" style="z-index:12;font-family:Poppins;">{{$setting->slider_text_3}}
                                    </rs-layer>
                                    
                                </rs-slide>

                        <?php }?>

                        <?php if(!empty($setting->image_4)) { ?>
                            
                                <rs-slide data-key="rs-4" data-title="Slide 4" data-thumb="<?php echo url('/public').'/'.@$setting->image_4; ?>" data-anim="ei:d;eo:d;s:d;r:0;t:slotslide-horizontal;sl:d;">
                                    <img src="<?php echo url('/public').'/'.@$setting->image_4; ?>" title="s6.jpg" width="500" height="200" data-bg="p:center center;" data-parallax="off" class="rev-slidebg" data-no-retina="">
                                    <rs-layer id="slider-1-slide-1-layer-19" class="rs-pxl-1" data-type="text" data-rsp_ch="on" data-xy="x:l,l,l,c;xo:50px,50px,35px,2px;yo:280px,291px,202px,208px;" data-text="w:normal;s:85,76,75,56;l:100,90,90,70;fw:700;a:left,left,left,center;" data-dim="w:724px,644px,653px,476px;" data-frame_0="x:-50,-38,-28,-17;" data-frame_1="st:1700;sp:1000;" data-frame_999="x:-50,-38,-28,-17;o:0;st:w;sp:1000;" style="z-index:12;font-family:Poppins;">{{$setting->slider_text_4}}
                                    </rs-layer>
                                    
                                </rs-slide>
                           
                        <?php }?>

                        </rs-slides>
                            <rs-static-layers>
                            </rs-static-layers>
                            <rs-progress class="rs-bottom" style="height: 5px; background: rgba(199,199,199,0.5);"></rs-progress>
                        </rs-module>

                    </rs-module-wrap>
                    <!-- END REVOLUTION SLIDER -->
                </div>
            </div>
        </div>
    </section>
    

    <section class="bg-white-f5">
        <div class="container  pt-30 pb-0">
            <div class="section-title">
                <div class="row justify-content-md-center">
                    <div class="col-md-12">
                        <div class="text-center mb-60">
                            <div class="tm-sc tm-sc-section-title section-title section-title-style1 text-center line-bottom-style3-bordered-line">
                                <div class="title-wrapper">
                                    <h1 class="title"><?php echo $home_setting->section_title_1; ?> </h1>
                                    <?php echo $home_setting->section_description_1; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="bg-img-no-repeat bg-img-right mt-5" data-tm-bg-img="<?php echo url('/public').'/front/images/bg/bg-shape-bconsul2.png'; ?>" style="background-image: url(<?php echo url('/public').'/front/images/bg/bg-shape-bconsul2.png'; ?>);">
        <div class="container pt-0 pb-0">
            <div class="section-content">
                <div class="row">
                    <div class="col-xl-6 col-lg-6">
                        <h2 class="title"><?php echo $home_setting->section_title_2; ?></h2>
                        <?php echo $home_setting->section_description_2; ?>
                    </div>
                    <div class="col-sm-12 col-lg-6 col-md-12">
                        <img data-src="<?php echo url('/public').'/'.@$home_setting->section_image_2; ?>" class="attachment-full lazy" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-img-no-repeat bg-img-right mt-5" data-tm-bg-img="<?php echo url('/public').'/front/images/bg/bg-shape-bconsul2.png'; ?>" style="background-image: url(<?php echo url('/public').'/front/images/bg/bg-shape-bconsul2.png'; ?>);">
        <div class="container pt-0 pb-30">
            <div class="section-content">
                <div class="row">
                    <div class="col-sm-12 col-lg-6 col-md-12">
                    <img data-src="<?php echo url('/public').'/'.@$home_setting->section_image_3; ?>" class="attachment-full lazy" alt="">
                    </div>
                    <div class="col-xl-6 col-lg-6">
                        <h2 class="title"><?php echo $home_setting->section_title_3; ?></h2>
                        <?php echo $home_setting->section_description_3; ?>
                    </div>
                    
                </div>
            </div>
        </div>
    </section>
    
    <section class="bg-white-f5">
        <div class="container pt-30 pb-30">
            <div class="section-content">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="tm-sc tm-sc-section-title section-title section-title-style1 text-center line-bottom-style3-bordered-line">
                            <div class="title-wrapper">
                                <h2 class="title"><?php echo $home_setting->service_title; ?></h2>
                            </div>
                        </div>
                        
                    </div>
                <?php if($service->count() > 0) { 
                    foreach ($service as $key => $val) {
                        
                    ?>
                    <div class="col-md-6 col-lg-6 col-xl-4 pb-5">
                        <div class="tm-sc tm-sc-icon-box icon-box icon-top tm-iconbox-icontype-font-icon text-center iconbox-style7-hover-moving-border bg-white iconbox-box-shadow  iconbox-theme-colored1 iconbox-default-padding icon-position-icon-top mb-lg-50" style="box-shadow: 0px 0px 50px  rgb(5 5 5 / 15%);">
                            <div class="icon-box-wrapper" style="cursor: pointer;" onclick="window.location.href = '<?php echo route('service', ['slug' => $val->slug]); ?>';">
                                <div class="icon-wrapper"> <a class="icon icon-type-image icon-default"> <img data-src="<?php echo url('/public').'/'.$val->image; ?>" alt="Image" class="lazy"> </a></div>
                                <div class="icon-text">
                                    <p class="icon-box-title mt-0">{{$val->title}}</p>
                                    <div class="content">
                                    <div class="tm-sc tm-sc-button mt-2"> 
                                        <a href="<?php echo route('service', ['slug' => $val->slug]); ?>"  class="btn btn-dark btn-sm btn-xs btn-round" rel="noopener noreferrer">View Detail</a></div>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="btn-view-details mt-0 p-20 bg-theme-colored1"> <a href="<?php echo route('service', ['slug' => $val->slug]); ?>" class="btn btn-plain-text-with-arrow btn-sm text-white"> View Details </a></div> -->
                        </div>
                    </div>

                <?php } } ?>
                </div>
            </div>
        </div>
    </section>


    


    <section class="">
        <div class="container pt-30 pb-30">
            <div class="section-content">
                <div class="row">
                    <div class="col-12">
                        <div class="tm-sc tm-sc-section-title section-title section-title-style1 text-center line-bottom-style3-bordered-line">
                            <div class="title-wrapper">
                                <h2 class="title"><?php echo $home_setting->why_title; ?></h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-4 pb-5">
                        <div class="tm-sc tm-sc-icon-box icon-box icon-top tm-iconbox-icontype-font-icon text-center iconbox-style7-hover-moving-border bg-white iconbox-box-shadow  iconbox-theme-colored1 iconbox-default-padding icon-position-icon-top mb-lg-50" style="box-shadow: 0px 0px 50px  rgb(5 5 5 / 15%);">
                            <div class="icon-box-wrapper">
                                <div class="icon-text">
                                    <h5><?php echo $home_setting->section_title_4; ?></h5>
                                    <p class="icon-box-title mt-0"><?php echo $home_setting->section_description_4; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-4 pb-5">
                        <div class="tm-sc tm-sc-icon-box icon-box icon-top tm-iconbox-icontype-font-icon text-center iconbox-style7-hover-moving-border bg-white iconbox-box-shadow  iconbox-theme-colored1 iconbox-default-padding icon-position-icon-top mb-lg-50" style="box-shadow: 0px 0px 50px  rgb(5 5 5 / 15%);">
                            <div class="icon-box-wrapper">
                                <div class="icon-text">
                                    <h5><?php echo $home_setting->section_title_5; ?></h5>
                                    <p class="icon-box-title mt-0"><?php echo $home_setting->section_description_5; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-4 pb-5">
                        <div class="tm-sc tm-sc-icon-box icon-box icon-top tm-iconbox-icontype-font-icon text-center iconbox-style7-hover-moving-border bg-white iconbox-box-shadow  iconbox-theme-colored1 iconbox-default-padding icon-position-icon-top mb-lg-50" style="box-shadow: 0px 0px 50px  rgb(5 5 5 / 15%);">
                            <div class="icon-box-wrapper">
                                <div class="icon-text">
                                    <h5><?php echo $home_setting->section_title_6; ?></h5>
                                    <p class="icon-box-title mt-0"><?php echo $home_setting->section_description_6; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php if(!empty($repair_service)) { ?>
        <section class="bg-white-f5">
            <div class="container pt-30 pb-30">
                <div class="section-content">
                    <div class="row justify-content-center">
                        <div class="col-12">
                            <div class="tm-sc tm-sc-section-title section-title section-title-style1 text-center line-bottom-style3-bordered-line">
                                <div class="title-wrapper">
                                    <h2 class="title">Our Services</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="justify-content-center owl-carousel mt-5">
                    <?php foreach ($repair_service as $key => $val) {  
                        ?>
                        <div class="row ">
                            <div class="col-md-12 col-lg-12 col-xl-12 pb-5">
                                <div class="tm-sc tm-sc-blog tm-sc-blog-masonry blog-style1-current-theme mb-lg-30">
                                    <article class="post type-post status-publish format-standard has-post-thumbnail">
                                        <div class="post-thumb-inner text-center" style="cursor: pointer;"  onclick="window.location.href = '<?php echo route('service', ['slug' => $val->slug]); ?>';">
                                            <div class="thumb p-3"> <img src="<?php echo url('/public').'/'.$val->image; ?>" alt="Image"></div>
                                        </div>
                                        <div class="entry-content text-center pr-1 pl-1 pb-2 pt-0" style="cursor: pointer;"  onclick="window.location.href = '<?php echo route('service', ['slug' => $val->slug]); ?>';">
                                            <h5 class="entry-title" style="font-weight:500">{{@$val->title}}</h5>
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

    <section class="">
        <div class="container pt-30 pb-30">
            <div class="section-title">
                <div class="row justify-content-md-center">
                    <div class="col-md-8">
                        <div class="text-center mb-60">
                            <div class="tm-sc tm-sc-section-title section-title section-title-style1 text-center line-bottom-style4-attached-double-lines1">
                                <div class="title-wrapper">
                                    <h2 class="title"> <span class=""><?php echo $home_setting->amazon_section; ?> </span></h2>
                                    <div class="title-seperator-line"></div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="section-content">
                <div class="row justify-content-md-center">
                    <?php if($deals->count() > 0) { 
                        foreach ($deals as $key => $amazon) {
                            
                        ?>
                    <div class="col-6 col-md-4 col-lg-2 p-2 d-flex align-items-center justify-content-center">
                        <?php echo $amazon['deal']; ?>
                    </div>
                    <?php } } ?>
                </div>
            </div>
        </div>
    </section>
    
    <?php if(!empty($products)) { ?>
        <section class="bg-white-f5">
            <div class="container pt-30 pb-30">
                <div class="section-content">
                    <div class="row justify-content-center">
                        <div class="col-12">
                            <div class="tm-sc tm-sc-section-title section-title section-title-style1 text-center line-bottom-style3-bordered-line">
                                <div class="title-wrapper">
                                    <h2 class="title">Desktop Computers</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="justify-content-center owl-carousel mt-5">
                    <?php foreach ($products as $key => $val) {  
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
    <!-- Section: News & Updates-->
    <section class="bg-white-f5">
        <div class="container pt-30 pb-30">
            <div class="section-title">
                <div class="row justify-content-md-center">
                    <div class="col-md-8">
                        <div class="text-center mb-10">
                            <div class="tm-sc tm-sc-section-title section-title section-title-style1 text-center line-bottom-style4-attached-double-lines1">
                                <div class="title-wrapper">
                                    <h2 class="title"> <span class="">Our </span> <span class="text-theme-colored1">Latest</span> Post</h2>
                                    <div class="title-seperator-line"></div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="section-content mt-5">
            
            <div class="row justify-content-center">
                <?php if($blog_post->count() > 0) { 
                            foreach ($blog_post as $blog) {
                        ?>
                <div class="col-md-6 col-lg-6 col-xl-3 pb-5">
                    <div class="tm-sc tm-sc-blog tm-sc-blog-masonry blog-style1-current-theme mb-lg-30">
                        <article class="post type-post status-publish format-standard has-post-thumbnail">
                            <a class="post-thumb-inner text-center" href="<?php echo route('post', ['slug' => $blog->slug]); ?>">
                                <div class="thumb p-3"> <img data-src="<?php echo url('/public').'/'.$blog->image; ?>" class="lazy" alt="Image"></div>
                            </a>
                            <div class="entry-content text-center p-3">
                                <a href="<?php echo route('post', ['slug' => $blog->slug]); ?>" class="text-dark">
                                    <?php $out = strlen($blog->title) > 55 ? substr($blog->title,0,55)."..." : $blog->title; echo $out;  ?>
                                </a>
                                <div class="content">
                                    <div class="tm-sc tm-sc-button mt-2 text-center"> 
                                        <a href="<?php echo route('post', ['slug' => $blog->slug]); ?>" class="btn btn-theme-colored1 btn-sm btn-block">Read More</a>
                                    </div>
                                </div>
                            </div>
                        </article>
                    </div>
                </div>

                <?php } } ?>

            </div>
        </div>
    </section>

    
    <!-- End Divider -->
    <!-- End Divider -->
</div>

@endsection

@section('script-bottom')
    
    <script>

    $(document).ready(function(){

        $('.owl-carousel').owlCarousel({
                loop: true,
                margin: 10,
                responsiveClass: true,
                responsive: {
                  0: {
                    items: 1,
                    nav: true,
                    loop: true,
                  },
                  600: {
                    items: 3,
                    nav: false,
                    loop: true,
                  },
                  1000: {
                    items: 4,
                    nav: true,
                    loop: true,
                    margin: 10
                  }
                }
              })


        $(".load-more").on('click',function(){
            var _totalCurrentResult=$(".product-box").length;
            console.log(_totalCurrentResult);
            // Ajax Reuqest

            $.ajax({
                type: 'POST',
                url: ajax_url+'/load-more-data',
                data: {
                    'skip': _totalCurrentResult,
                    '_token': $('meta[name="csrf-token"]').attr('content'),
                },
                dataType: "json",
                beforeSend:function(){
                    $(".load-more").html('Loading...');
                },
                success:function(response){
                    console.log(response);
                    var _html='';
                    var image="<?php echo url('/public');?>/";
                    var url="<?php echo url('/blog');?>/";
                    $.each(response,function(index,value){
                        _html+='<li class="list-group-item product-box"> <div class="media align-items-lg-center flex-column flex-lg-row"> <div> <img src="'+image+''+value.image+'" alt="'+value.title+'" width="200" class="ml-lg-1 order-1 order-lg-2"> </div><div class="media-body order-2 order-lg-4 ml-4"> <h5 class="mt-0 font-weight-bold mb-2">'+value.title+'</h5> <p class="font-italic text-muted mb-0 small">'+value.short_description+'</p><div class="d-flex align-items-center justify-content-between mt-3"> <ul class="styled-icons icon-md icon-dark icon-rounded icon-theme-colored1"><li><a href="https://www.facebook.com/sharer/sharer.php?u='+url+''+value.slug+'" class="social-button " target="_blank"><span class="fa fa-facebook-official"></span></a></li><li><a href="https://twitter.com/intent/tweet?text='+value.title+'&amp;url='+url+''+value.slug+'" class="social-button " target="_blank"><span class="fa fa-twitter"></span></a></li><li><a href="http://www.linkedin.com/shareArticle?mini=true&amp;url='+url+''+value.slug+'&amp;title='+value.title+'&amp;summary='+value.short_description+'" class="social-button " id="" target="_blank"><span class="fa fa-linkedin"></span></a></li><li><a href="https://wa.me/?text='+url+''+value.slug+'" class="social-button " id="" target="_blank"><span class="fa fa-whatsapp"></span></a></li> </ul> <div class=" split-nav-menu clearfix widget-brochure-box clearfix"><a class="tm-widget tm-widget-brochure-box tm-widget-brochure-box-default brochure-box brochure-box-default brochure-box-theme-colored1" href="'+url+''+value.slug+'"> <h5 class="text">Read More</h5> </a></div></div></div></div></li>';
                    });
                    $(".blog_list").append(_html);
                    // Change Load More When No Further result
                    var _totalCurrentResult=$(".product-box").length;
                    var _totalResult=parseInt($(".load-more").attr('data-totalResult'));
                    if(_totalCurrentResult==_totalResult){
                        $(".load-more").remove();
                    }else{
                        $(".load-more").html('Load More');
                    }
                },
                error: function(response) {
                    alert(JSON.stringify(response));
                    toastr.error("Something went wrong", '', {
                        "progressBar": true
                    });
                }
            });

           
        });
    });


    </script>
     
@endsection