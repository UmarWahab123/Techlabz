<!DOCTYPE html>
<html lang="en">
    <head>
        <?php $setting = App\Models\Setting::first(); ?>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <meta content="Sunil Kumar" name="author">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="viewport"
    content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="<?php echo url('/public').'/'; ?>techlabz-fav.png" rel="shortcut icon">

        <?php if(isset($blog_post->meta_title) && !empty($blog_post->meta_title)) { ?>
            <meta name="title" content="{{@$blog_post->meta_title}}">
        
        <?php } else if(isset($product->meta_title) && !empty($product->meta_title)) { ?>
            <meta name="title" content="{{@$product->meta_title}}">

        <?php } else {?>

            <?php if(Route::currentRouteName() == 'homepage' || Route::currentRouteName() == '') {?>
                <meta name="title" content="{{@$setting->home_meta_title}}">
            <?php } else if(Route::currentRouteName() == 'service') {?>
                <meta name="title" content="{{@$setting->service_meta_title}}">
            <?php } else if(Route::currentRouteName() == 'about_us') {?>
                <meta name="title" content="{{@$setting->about_meta_title}} ">
                <?php } else if(Route::currentRouteName() == 'contact_us') {?>
                <meta name="title" content="{{@$setting->contact_meta_title}} ">
            <?php }?>
            
        <?php }?>

        <?php if(isset($blog_post->meta_description) && !empty($blog_post->meta_description)) { ?>
            <meta name="description" content="{{@$blog_post->meta_description}}">
        <?php } else if(isset($product->meta_description) && !empty($product->meta_description)) { ?>
            <meta name="description" content="{{@$product->meta_description}}">
        
        <?php } else {?>
            <?php if(Route::currentRouteName() == 'homepage' || Route::currentRouteName() == '') {?>
                <meta name="description" content="{{@$setting->home_meta_description}}">
            <?php } else if(Route::currentRouteName() == 'service') {?>
                <meta name="description" content="{{@$setting->service_meta_description}}">
            <?php } else if(Route::currentRouteName() == 'about_us') {?>
                <meta name="description" content="{{@$setting->about_meta_description}} ">
                <?php } else if(Route::currentRouteName() == 'contact_us') {?>
                <meta name="description" content="{{@$setting->contact_meta_description}}">
            <?php }?>
        <?php }?>

        <?php if(isset($blog_post->meta_keyword) && !empty($blog_post->meta_keyword)) { ?>
            <meta name="keywords" content="{{@$blog_post->meta_keyword}}">
        <?php } else if(isset($product->meta_keyword) && !empty($product->meta_keyword)) { ?>
            <meta name="keywords" content="{{@$product->meta_keyword}}">
        
        <?php } else {?>
        
            <?php if(Route::currentRouteName() == 'homepage' || Route::currentRouteName() == '') {?>
                <meta name="keywords" content="{{@$setting->home_meta_keyword}}">
            <?php } else if(Route::currentRouteName() == 'service') {?>
                <meta name="keywords" content="{{@$setting->service_meta_keyword}}">
                <?php } else if(Route::currentRouteName() == 'about_us') {?>
                <meta name="keywords" content="{{@$setting->about_meta_keyword}}">
                <?php } else if(Route::currentRouteName() == 'contact_us') {?>
                <meta name="keywords" content="{{@$setting->contact_meta_keyword}}">
            <?php }?>
        <?php }?>

        <title>{{@$setting->site_title}}</title>
        @include('front.layouts.head')
            <!-- start Gist JS code-->
<script>
    (function(d,h,w){var gist=w.gist=w.gist||[];gist.methods=['trackPageView','identify','track','setAppId'];gist.factory=function(t){return function(){var e=Array.prototype.slice.call(arguments);e.unshift(t);gist.push(e);return gist;}};for(var i=0;i<gist.methods.length;i++){var c=gist.methods[i];gist[c]=gist.factory(c)}s=d.createElement('script'),s.src="https://widget.getgist.com",s.async=!0,e=d.getElementsByTagName(h)[0],e.appendChild(s),s.addEventListener('load',function(e){},!1),gist.setAppId("h494kt9y"),gist.trackPageView()})(document,'head',window);
</script>
<!-- end Gist JS code-->
    </head>

    <body>
        <style type="text/css">
            .error{
                color: red !important;
            }
            .ladda-button {
                padding: 10px 17px;
                font-size:unset;
            }

            @media all and (min-width:0px) and (max-width: 767.98px) {
                .head_menu {
                    margin-right: 25px !important;
                }
            }
            .loading_1 {
                position: fixed;
                z-index: 999;
                height: 2em;
                width: 2em;
                overflow: show;
                margin: auto;
                top: 0;
                left: 0;
                bottom: 0;
                right: 0;
                }

                /* Transparent Overlay */
                .loading_1:before {
                content: '';
                display: block;
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                    background: radial-gradient(rgba(20, 20, 20,.10%), rgba(0, 0, 0, .8));

                background: -webkit-radial-gradient(rgba(20, 20, 20,10%), rgba(0, 0, 0,.8));
                }

        </style>
        <div id="wrapper" class="clearfix">
            <div class="loading_1" style="display: none;">
                <i class="fa fa-spinner fa-pulse fa-5x fa-fw"></i>
                <span class="sr-only">Loading...</span>
            </div>
            @yield('content')
        </div>
        @include('front.layouts.footer')  
        @include('front.layouts.footer-script')
        
    </body>
</html>