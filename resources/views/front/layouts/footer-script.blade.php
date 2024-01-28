        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="{{Config::get('app.url')}}/{{ URL::asset('front/assets/dist/js/custom.js')}}" defer></script>
        <script src="{{Config::get('app.url')}}/{{ URL::asset('front/assets/dist/js/extra-rev-slider.js')}}" defer></script>
        <?php if(Route::currentRouteName() == 'contact_us' || Route::currentRouteName() == 'service' || Route::currentRouteName() == 'checkout' || Route::currentRouteName() == 'user.profile') {?>
        <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script> -->
        
        <?php }?>      
        
        
<script type="text/javascript">
    var ajax_url = "<?php echo Config::get('app.url'); ?>";

    document.addEventListener("DOMContentLoaded", function() {
  var lazyloadImages = document.querySelectorAll("img.lazy");    
  var lazyloadThrottleTimeout;
  
  function lazyload () {
    if(lazyloadThrottleTimeout) {
      clearTimeout(lazyloadThrottleTimeout);
    }    
    
    lazyloadThrottleTimeout = setTimeout(function() {
        var scrollTop = window.pageYOffset;
        lazyloadImages.forEach(function(img) {
            if(img.offsetTop < (window.innerHeight + scrollTop)) {
              img.src = img.dataset.src;
              img.classList.remove('lazy');
            }
        });
        if(lazyloadImages.length == 0) { 
          document.removeEventListener("scroll", lazyload);
          window.removeEventListener("resize", lazyload);
          window.removeEventListener("orientationChange", lazyload);
        }
    }, 20);
  }
  
  document.addEventListener("scroll", lazyload);
  window.addEventListener("resize", lazyload);
  window.addEventListener("orientationChange", lazyload);
});


</script>

<?php if(Route::currentRouteName() == 'contact_us' || Route::currentRouteName() == 'service' || Route::currentRouteName() == 'checkout' || Route::currentRouteName() == 'product-detail' || Route::currentRouteName() == 'cart' || Route::currentRouteName() == 'user.profile' ) {?>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://lab.hakim.se/ladda/dist/spin.min.js"></script>
<script src="https://lab.hakim.se/ladda/dist/ladda.min.js"></script>
        <?php }?>
        
        @yield('script-bottom')
        