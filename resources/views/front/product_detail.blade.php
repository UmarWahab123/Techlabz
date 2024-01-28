@extends('front.layouts.master')

@section('css')
    <style>

    .owl-carousel .owl-stage {
        display: flex;
        text-align: center;
    }

    #thumbs .owl-item  {
        border: solid 1px #efefef;
    }

    #big .owl-item img {
        width: auto;
        height: 300px;
    }

    div#big .owl-nav {
        display: none;
    }
    #big:hover .owl-nav {
        display: block;
    }

    #big .owl-stage-outer {
        border: solid 1px #efefef;
    }

    .nav-pills .nav-link.active, .nav-pills .show>.nav-link{
        background-color: #00c3ed;
    }
    .btn-primary {
        color: #fff;
        background-color: #00c3ed;
        border-color: #00c3ed;
    }

    .icon-box.iconbox-default-padding .icon-box-wrapper {
        padding: 30px 15px 30px 15px;
    }

    .custom_button {
        text-align: center;
        border-radius: 5px;
        display: inline-block;
        height: 60px;
        line-height: 62px;
        color: #fff;
        background: #1ab69d;
        padding: 0 30px;
        font-size: 15px;
        font-weight: 500;
        -webkit-transition: 0.4s;
        transition: 0.4s;
        border: 0 none;
        overflow: hidden;
        position: relative;
        z-index: 1
    }

    .new_thumb img{
        text-align: center;
        height: 180px;
        width: 180px !important;
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
                        <nav role="navigation" class="breadcrumb-trail breadcrumbs">
                            <div class="breadcrumbs">
                                <span class="trail-item trail-begin pr-1">
                                    <a href="{{route('homepage')}}"><span>Home</span></a>
                                </span>
                                <span><i class="fa fa-angle-right pr-1"></i></span>
                                <span class="trail-item pr-1"><a href="<?php echo route('service', ['slug' => 'sales']); ?>"><span>Sales</span></a></span>
                                <span><i class="fa fa-angle-right pr-1"></i></span>
                                <?php if(!empty(@$product->service)) { ?>
                                    <span class="trail-item pr-1"><a href="<?php echo route('service', ['slug' => @$product->service->slug]); ?>"><span>{{@$product->service->title}}</span></a></span>
                                    <span><i class="fa fa-angle-right pr-1"></i></span>
                                <?php }?>
                                <?php if(!empty(@$product->sub_service)) { ?>
                                    <span class="trail-item pr-1"><a href="<?php echo route('brand', ['slug' => $product->sub_service->slug]); ?>"><span>{{@$product->sub_service->title}}</span></a></span>
                                    <span><i class="fa fa-angle-right pr-1"></i></span>
                                <?php }?>
                                <?php if(!empty(@$product->brand)) { ?>
                                    <span class="trail-item pr-1"><a href="<?php echo route('product', ['brand' => $product->brand->slug,'slug' => $product->sub_service->slug]); ?>"><span>{{@$product->brand->title}}</span></a></span>
                                    <span><i class="fa fa-angle-right pr-1"></i></span>
                                <?php }?>
                                <span class="trail-item trail-end active">{{@$product->title}}</span>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container">
            <div class="section-content">
                <div class="row">
                    <div class="col-md-12 col-lg-9">
                        <div class="row">
                            <div class="col-md-12 col-lg-5">
                                <div class="row">
                                    <div class="col-md-12 col-lg-12 main-slider owl-carousel mb-5" id="big">
                                        <div class="row item">
                                            <div class="mb-md-10 col-12 p-3">
                                                <img  src="<?php echo url('/public').'/'.$product->image; ?>" alt="">
                                            </div>
                                        </div>
                                        <?php if(!empty($product->images)) { 
                                            foreach ($product->images as $key => $val) {
                                            ?>
                                            
                                            <div class="row item">
                                                <div class="mb-md-10 col-12 p-3">
                                                    <img  src="<?php echo url('/public').'/'.$val->image; ?>" alt="">
                                                </div>
                                            </div>

                                        <?php } }?>

                                    </div>
                                    <div class="col-md-12 col-lg-12 main-slider owl-carousel" id="thumbs">
                                        <div class="row item ">
                                            <div class="mb-md-10 col-12 p-4">
                                                <img  src="<?php echo url('/public').'/'.$product->image; ?>" alt="">
                                            </div>
                                        </div>
                                        <?php if(!empty($product->images)) { 
                                            foreach ($product->images as $key => $val) {
                                            ?>
                                            
                                            <div class="row item ">
                                                <div class="mb-md-10 col-12  p-4">
                                                    <img  src="<?php echo url('/public').'/'.$val->image; ?>" alt="">
                                                </div>
                                            </div>

                                        <?php } }?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-7">
                                <h4 class="line-bottom-theme-colored1">{{@$product->title}}</h4>
                                <hr style="background: #00c3ed; height:1px;">
                                <!-- <h5 class="text-theme-colored1 mb-10"><i class="fa fa-gbp"></i> <span class="entry-date published updated">349.99</span></h5> -->
                                <div class="row">
                                    <div class="col-12">
                                        {{$product->short_description}}
                                        <form class="pt-3">
                                            <?php if($hard_disk->count() > 0) { ?>
                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-sm-5 col-form-label">Upgrade Your Hard Disk</label>
                                                <div class="col-sm-7">
                                                    <select class="form-control form-control-sm hard_disk" name="hard_disk">
                                                        <?php 
                                                            foreach ($hard_disk as $key => $disk) {
                                                        ?>
                                                        <option value="{{@$disk->id}}" data-amount="{{@$disk->price}}">{{@$disk->name}} 
                                                            <?php if($disk->price > 0) { ?>    
                                                                (+£{{$disk->price}})
                                                            <?php } else {?>
                                                                (Included)
                                                            <?php }?>
                                                        </option>
                                                        <?php }?>
                                                    </select>
                                                </div>
                                            </div>
                                            <?php }?>

                                            <?php if($ram->count() > 0) { ?>
                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-sm-5 col-form-label">Upgrade Your RAM</label>
                                                <div class="col-sm-7">
                                                    <select class="form-control form-control-sm ram_upgrade" name="ram">
                                                    <?php 
                                                            foreach ($ram as $key => $disk) {
                                                        ?>
                                                        <option value="{{@$disk->id}}" data-amount="{{@$disk->price}}">{{@$disk->name}} 
                                                            <?php if($disk->price > 0) { ?>    
                                                                (+£{{$disk->price}})
                                                            <?php } else {?>
                                                                (Included)
                                                            <?php }?>
                                                        </option>
                                                    <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <?php } ?>

                                            <?php if($warrenty->count() > 0) { ?>
                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-sm-5 col-form-label">Warranty </label>
                                                <div class="col-sm-7">
                                                    <select class="form-control form-control-sm warrenty" name="warrenty">
                                                    <?php 
                                                            foreach ($warrenty as $key => $disk) {
                                                        ?>
                                                        <option value="{{@$disk->id}}" data-amount="{{@$disk->price}}">{{@$disk->name}} 
                                                            <?php if($disk->price > 0) { ?>    
                                                                (+£{{$disk->price}})
                                                            <?php } else {?>
                                                                (Included)
                                                            <?php }?>
                                                        </option>
                                                    <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <?php } ?>

                                            <?php if($os->count() > 0) { ?>
                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-sm-5 col-form-label">Operating System </label>
                                                <div class="col-sm-7">
                                                    <select class="form-control form-control-sm os" name="os">
                                                    <?php 
                                                            foreach ($os as $key => $disk) {
                                                        ?>
                                                        <option value="{{@$disk->id}}" data-amount="{{@$disk->price}}">{{@$disk->name}} 
                                                            <?php if($disk->price > 0) { ?>    
                                                                (+£{{$disk->price}})
                                                            <?php } else {?>
                                                                (Included)
                                                            <?php }?>
                                                        </option>
                                                    <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <?php } ?>
                                        </form>
                                    </div>
                                    <div class="col-12">
                                        <div class="product_meta">
                                            <div class="posted_in">Category: <a href="javascrpt:;" rel="tag">{{@$product->sub_service->title}}</a></div>
                                            <div class="tagged_as">Tags: 
                                            <?php if(!empty(@$product->tags)) {
                                              foreach (@$product->tags as $key => $val) { ?>
                                                <a href="javascrpt:;" rel="tag">{{$val->tag_name}}</a> ,
                                              <?php }
                                            } ?>

                                            
                                            </div>
                                            <div class="attributes">Product Brand: <strong style="font-weight: 600;">{{@$product->brand->title}} </strong></div>
                                            <div class="attributes">Product Grade: <strong style="font-weight: 600;">{{@$product->grade}}</strong></div>
                                            <div class="attributes">Product Processor Family: <strong style="font-weight: 600;">{{@$product->processer}}</strong></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <ul class="tm-widget tm-widget-social-list tm-widget-social-list-custom styled-icons  icon-dark  icon-rounded icon-theme-colored1 ">
                                        <li><a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo route('product', ['slug' => $product->slug]); ?>" class="social-button " id="" target="_blank"><span class="fa fa-facebook-official"></span></a></li>
                                        <li><a href="https://twitter.com/intent/tweet?text=<?php echo $product->title; ?>&amp;url=<?php echo route('product', ['slug' => $product->slug]); ?>" class="social-button " id="" target="_blank"><span class="fa fa-twitter"></span></a></li>
                                        <li><a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo route('product', ['slug' => $product->slug]); ?>&amp;title=<?php echo $product->title; ?>&amp;summary=<?php echo $product->short_description; ?>" class="social-button " id="" target="_blank"><span class="fa fa-linkedin"></span></a></li>
                                        <li><a href="https://wa.me/?text=<?php echo route('product', ['slug' => $product->slug]); ?>" class="social-button " id="" target="_blank"><span class="fa fa-whatsapp"></span></a></li>
                                        </ul>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-12">
                                        <div class="content">
                                            <h4 class="text-theme-colored1 mb-0"><i class="fa fa-gbp"></i> <span class="entry-date published updated price">{{$product->price}}</span></h4>
                                            <div class="mt-4 btn-view-details"> 
                                                <?php if($cart_val > 0) { ?>
                                                    <a href="javascript:;"  class="btn btn-theme-colored2 btn-sm remove-from-cart" data-id="{{$product->id}}">Remove From Cart</a>

                                                <?php } else {?>
                                                <input type="number" min="1" value="1" name="qun" id="quantity" class="form-control w-25 d-inline">
                                                <a href="javascript:;"  class="btn btn-theme-colored1 btn-sm d-inline" onclick="add_to_cart(this)">Add to Cart</a>
                                                <?php }?>
                                                <!-- <a href="javascript:;"  class="btn btn-theme-colored1 btn-sm" >Add to Wishlist</a> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="col-12">
                                <ul class="nav nav-tabs nav-pills nav-fill" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="spec-tab" data-toggle="tab" href="#spec" role="tab" aria-controls="spec"
                                            aria-selected="true">Specification</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
                                            aria-selected="true">Description</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile"
                                            aria-selected="false">Grading Info</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact"
                                            aria-selected="false">Others</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="spec" role="tabpanel" aria-labelledby="spec-tab">
                                        <?php echo $product->specification; ?>
                                    </div>
                                    <div class="tab-pane fade show" id="home" role="tabpanel" aria-labelledby="home-tab">
                                        <?php echo $product->description; ?>
                                    </div>
                                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                        <?php echo $product->grading; ?>
                                    </div>
                                    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                        <?php echo $product->others; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-3">
                        <div class="row">
                            <div class="col-12 mb-2">
                                <div class="tm-sc tm-sc-icon-box icon-box icon-top tm-iconbox-icontype-font-icon text-center iconbox-style7-hover-moving-border bg-white iconbox-box-shadow  iconbox-theme-colored1 iconbox-default-padding icon-position-icon-top mb-lg-50 border">
                                    <div class="icon-box-wrapper">
                                        <div class=""> 
                                            <a class="icon icon-type-image icon-default"> 
                                                <img src="<?php echo url('/public').'/delivery-truck.png'; ?>" alt="Image"> 
                                            </a>
                                        </div>
                                        <div class="icon-text">
                                            <h5 class="icon-box-title mt-0"> FREE SHIPPING</h5>
                                            <div class="content">
                                                <p>Free Mainland UK Shipping on most orders.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12  mb-2">
                                <div class="tm-sc tm-sc-icon-box icon-box icon-top tm-iconbox-icontype-font-icon text-center iconbox-style7-hover-moving-border bg-white iconbox-box-shadow  iconbox-theme-colored1 iconbox-default-padding icon-position-icon-top mb-lg-50 border">
                                    <div class="icon-box-wrapper">
                                        <div class=""> 
                                            <a class="icon icon-type-image icon-default"> 
                                                <img src="<?php echo url('/public').'/warranty.png'; ?>" alt="Image"> 
                                            </a>
                                        </div>
                                        <div class="icon-text">
                                            <h5 class="icon-box-title mt-0"> WARRANTY</h5>
                                            <div class="content">
                                                <p>Free 90 days warranty</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="tm-sc tm-sc-icon-box icon-box icon-top tm-iconbox-icontype-font-icon text-center iconbox-style7-hover-moving-border bg-white iconbox-box-shadow  iconbox-theme-colored1 iconbox-default-padding icon-position-icon-top mb-lg-50 border">
                                    <div class="icon-box-wrapper">
                                        <div class=""> 
                                            <a class="icon icon-type-image icon-default"> 
                                                <img src="<?php echo url('/public').'/customer-service.png'; ?>" alt="Image"> 
                                            </a>
                                        </div>
                                        <div class="icon-text">
                                            <h5 class="icon-box-title mt-0"> SUPPORT</h5>
                                            <div class="content">
                                                <p>24x7 Email Support.</p>
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
    <section>
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
                    <div class="justify-content-center owl-carousel mt-5" id="related_products">
                    <?php foreach ($sub_product as $key => $val) {  
                        ?>
                        <div class="row ">
                            <div class="col-md-12 col-lg-12 col-xl-12 pb-5">
                                <div class="tm-sc tm-sc-blog tm-sc-blog-masonry blog-style1-current-theme mb-lg-30">
                                    <article class="post type-post status-publish format-standard has-post-thumbnail">
                                        <div class="post-thumb-inner text-center">
                                            <a class="thumb p-3 icon-type-image new_thumb" href='<?php echo route('product-detail', ['slug' => $val->slug]); ?>'> <img src="<?php echo url('/public').'/'.$val->image; ?>" alt="Image"></a>
                                        </div>
                                        <div class="entry-content text-center pr-1 pl-1 pb-2">
                                            <a href='<?php echo route('product-detail', ['slug' => $val->slug]); ?>'>
                                            <p class="entry-title text-dark" style="font-weight:500">{{@$val->title}}</p>
                                            <p class="entry-date published  text-dark"><i class="fa fa-gbp"></i>{{$val->price}}</p>
                                            </a>
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

$(document).ready(function() {

    var price = <?php echo $product->price; ?>

    $('.hard_disk').on('change', function() {
        console.log($(this).find(':selected').data('amount'));

        let disk_price = $('.hard_disk').find(':selected').data('amount');
        let ram_upgrade = $('.ram_upgrade').find(':selected').data('amount');
        let warrenty = $('.warrenty').find(':selected').data('amount');
        let os = $('.os').find(':selected').data('amount');
        let total_price = parseFloat(price) + parseFloat(disk_price) + parseFloat(ram_upgrade) + parseFloat(warrenty) + parseFloat(os)
        $('.price').text(total_price);

    });
    $('.ram_upgrade').on('change', function() {
        console.log($(this).find(':selected').data('amount'));

        let disk_price = $('.hard_disk').find(':selected').data('amount');
        let ram_upgrade = $('.ram_upgrade').find(':selected').data('amount');
        let warrenty = $('.warrenty').find(':selected').data('amount');
        let os = $('.os').find(':selected').data('amount');
        let total_price = parseFloat(price) + parseFloat(disk_price) + parseFloat(ram_upgrade) + parseFloat(warrenty) + parseFloat(os)
        $('.price').text(total_price);

    });
    $('.warrenty').on('change', function() {
        console.log($(this).find(':selected').data('amount'));

        let disk_price = $('.hard_disk').find(':selected').data('amount');
        let ram_upgrade = $('.ram_upgrade').find(':selected').data('amount');
        let warrenty = $('.warrenty').find(':selected').data('amount');
        let os = $('.os').find(':selected').data('amount');
        let total_price = parseFloat(price) + parseFloat(disk_price) + parseFloat(ram_upgrade) + parseFloat(warrenty) + parseFloat(os)
        $('.price').text(total_price);


    });
    $('.os').on('change', function() {
        console.log($(this).find(':selected').data('amount'));

        let disk_price = $('.hard_disk').find(':selected').data('amount');
        let ram_upgrade = $('.ram_upgrade').find(':selected').data('amount');
        let warrenty = $('.warrenty').find(':selected').data('amount');
        let os = $('.os').find(':selected').data('amount');
        let total_price = parseFloat(price) + parseFloat(disk_price) + parseFloat(ram_upgrade) + parseFloat(warrenty) + parseFloat(os)
        $('.price').text(total_price);


    });
    

    let disk_price = $('.hard_disk').find(':selected').data('amount');
    let ram_upgrade = $('.ram_upgrade').find(':selected').data('amount');
    let warrenty = $('.warrenty').find(':selected').data('amount');
    let os = $('.os').find(':selected').data('amount');
    let total_price = parseFloat(price) + parseFloat(disk_price) + parseFloat(ram_upgrade) + parseFloat(warrenty) + parseFloat(os)
    $('.price').text((isNaN(total_price)) ? price : total_price);


  var bigimage = $("#big");
  var thumbs = $("#thumbs");
  //var totalslides = 10;
  var syncedSecondary = true;

  bigimage
    .owlCarousel({
    items: 1,
    // slideSpeed: 5000,
    nav: true,
    autoplay: false,
    dots: false,
    loop: true,
    // responsiveRefreshRate: 5000,
    navText: [
      '<i class="fa fa-arrow-left" aria-hidden="true"></i>',
      '<i class="fa fa-arrow-right" aria-hidden="true"></i>'
    ]
  })
    .on("changed.owl.carousel", syncPosition);

  thumbs
    .on("initialized.owl.carousel", function() {
    thumbs
      .find(".owl-item")
      .eq(0)
      .addClass("current");
  })
    .owlCarousel({
    items: 4,
    dots: false,
    nav: false,
    // smartSpeed: 200,
    // slideSpeed: 800,
    margin:15,
    slideBy: 3,
    responsiveRefreshRate: 2000
  })
    .on("changed.owl.carousel", syncPosition2);

  function syncPosition(el) {
    //if loop is set to false, then you have to uncomment the next line
    //var current = el.item.index;

    //to disable loop, comment this block
    var count = el.item.count - 1;
    var current = Math.round(el.item.index - el.item.count / 2 - 0.5);

    if (current < 0) {
      current = count;
    }
    if (current > count) {
      current = 0;
    }
    //to this
    thumbs
      .find(".owl-item")
      .removeClass("current")
      .eq(current)
      .addClass("current");
    var onscreen = thumbs.find(".owl-item.active").length - 1;
    var start = thumbs
    .find(".owl-item.active")
    .first()
    .index();
    var end = thumbs
    .find(".owl-item.active")
    .last()
    .index();

    if (current > end) {
      thumbs.data("owl.carousel").to(current, 100, true);
    }
    if (current < start) {
      thumbs.data("owl.carousel").to(current - onscreen, 100, true);
    }
  }

  function syncPosition2(el) {
    if (syncedSecondary) {
      var number = el.item.index;
      bigimage.data("owl.carousel").to(number, 100, true);
    }
  }

  thumbs.on("click", ".owl-item", function(e) {
    e.preventDefault();
    var number = $(this).index();
    bigimage.data("owl.carousel").to(number, 300, true);
  });

  $('#related_products').owlCarousel({
        loop: true,
        margin: 10,
        autoplay:true,
        dots: true,
        autoplayTimeout:3000,
        autoplayHoverPause:true,
        responsive: {
          0: {
            items: 1,
          },
          600: {
            items: 3,
          },
          1000: {
            items: 5,
            margin: 10
          }
        }
      })

      $('.container').find("table").css('width', '100%')
});

function add_to_cart(obj){

    let disk_id = $('.hard_disk').find(':selected').val();
    let ram_upgrade = $('.ram_upgrade').find(':selected').val();
    let warrenty = $('.warrenty').find(':selected').val();
    let os = $('.os').find(':selected').val();

    $.ajax({
        type: 'POST',
        url: ajax_url+'/add-to-cart',
        data: {
            'id': '<?php echo $product->id; ?>',
            'disk_id': disk_id,
            'ram_id': ram_upgrade,
            'warrenty_id': warrenty,
            'os_id': os,
            'quantity': $('#quantity').val(),
            '_token': $('meta[name="csrf-token"]').attr('content'),
        },
        dataType: "json",
        success: function(response) {
            if (response.status) {
                toastr.success(response.message, '', {
                    "progressBar": true
                });

                setTimeout(function () {
                    window.location.reload();
                }, 4000);

            } 
        },
        error: function(response) {
            toastr.error("Something went wrong", '', {
                "progressBar": true
            });
        }
    });
    
}

$(".remove-from-cart").click(function (e) {
    e.preventDefault();

    var ele = $(this);

    if(confirm("Are you sure want to remove?")) {
        $.ajax({
            url: "{{ route('remove.from.cart') }}",
            method: "DELETE",
            data: {
                _token: '{{ csrf_token() }}', 
                id: ele.attr("data-id")
            },
            success: function (response) {
                toastr.success("Product Removed from Cart Successfully!", '', {
                    "progressBar": true
                });

                setTimeout(function () {
                    window.location.reload();
                }, 4000);
            }
        });
    }
});


</script>
     
@endsection