<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-N5GE213WMT"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-N5GE213WMT');
</script>

<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-PXNDX92');</script>
<!-- End Google Tag Manager -->

    <!-- Required meta tags -->
    <?php $setting = App\Models\Setting::first(); ?>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('front.layouts.new-head')
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw==" crossorigin="anonymous" />
    <!-- <link rel="stylesheet" type="text/css" href="css/style.css"> -->
    <link href="{{Config::get('app.url')}}/{{ URL::asset('new-frontend/css/style.css')}}" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css2?family=Open Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css">
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
@yield('css')
<title>{{@$setting->site_title}}</title>

</head>
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
<body>
@include('front.layouts.topbar2')  

@yield('content')


<!-- @include('front.layouts.footer2')   -->
@include('front.layouts.footer-script')
@yield('js')
<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<!-- slider script -->
<script src="{{Config::get('app.url')}}/{{ URL::asset('new-frontend/js/custom.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<!-- <script src="js/custom.js"></script> -->
<script>
  $(document).ready(function() {
          $(".repair_contact_message").submit(function(event) {
  // Prevent default form submission behavior
              event.preventDefault();
              var token = $('input[name=_token]').val();
              var formData=$('.repair_contact_message').serialize();
              $.ajax({
                  type: "POST",
                  headers:{'X-CSRF-TOKEN': token},
                  url: "{{url('/add-service-contact') }}",
                  data: formData,
                  success: function(response) {
                      if(response.status) {
                         
                         toastr.success("We Have recieved your message! We will contact you shortly!", '', {
                              "progressBar": true,
                              "positionClass": "toast-top-center",
                              "showDuration": "10000",
                              "hideDuration": "10000",
                              "timeOut": "10000",
                              "extendedTimeOut": "10000",
                          });
                          $('.repair_contact_message')[0].reset();  
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
            });
          });

          $(document).ready(function() {
          $("#contact_us").submit(function(event) {
  // Prevent default form submission behavior
              event.preventDefault();
              var token = $('input[name=_token]').val();
              var formData=$('#contact_us').serialize();
              $.ajax({
                  type: "POST",
                  headers:{'X-CSRF-TOKEN': token},
                  url: "{{url('/footer-contact-us') }}",
                  data: formData,
                  success: function(response) {
                      if(response.status) {
                         
                         toastr.success("Message sent successfully! We will contact you shortly!", '', {
                              "progressBar": true,
                              "positionClass": "toast-top-center",
                              "showDuration": "10000",
                              "hideDuration": "10000",
                              "timeOut": "10000",
                              "extendedTimeOut": "10000",
                          });
                          $('#contact_us')[0].reset();  

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
            });
          });

</script>
</body>
</html>