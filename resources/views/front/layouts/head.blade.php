        <?php if(Route::currentRouteName() == 'contact_us' || Route::currentRouteName() == 'service' || Route::currentRouteName() == 'checkout' || Route::currentRouteName() == 'user.profile') {?>
        <link href="https://lab.hakim.se/ladda/dist/ladda.min.css" rel="stylesheet" type="text/css">
        <?php }?>
        <link href="{{Config::get('app.url')}}/{{ URL::asset('owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">

        <link href="{{Config::get('app.url')}}/{{ URL::asset('owlcarousel/assets/owl.theme.default.min.css')}}" rel="stylesheet">
        <link href="{{Config::get('app.url')}}/{{ URL::asset('front/assets/dist/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" defer >
        <link href="{{Config::get('app.url')}}/{{ URL::asset('front/assets/dist/css/animate.min.css')}}" rel="stylesheet" type="text/css" defer>
        <link href="{{Config::get('app.url')}}/{{ URL::asset('front/assets/dist/css/javascript-plugins-bundle.css')}}" rel="stylesheet" defer>
        <!-- CSS | menuzord megamenu skins -->
        <link href="{{Config::get('app.url')}}/{{ URL::asset('front/assets/dist/js/menuzord/css/menuzord.css')}}" rel="stylesheet" defer>

        

        <!-- CSS | timeline -->
        <link href="{{Config::get('app.url')}}/{{ URL::asset('front/assets/dist/js/timeline-cp-responsive-vertical/timeline-cp-responsive-vertical.css')}}" rel="stylesheet" type="text/css">
        <!-- CSS | Main style file -->
        <!-- <link href="{{Config::get('app.url')}}/{{ URL::asset('front/assets/dist/css/style-main.css')}}" rel="stylesheet" type="text/css"> -->
        <link id="menuzord-menu-skins" href="{{Config::get('app.url')}}/{{ URL::asset('front/assets/dist/js/menuzord/css/skins/menuzord-rounded-boxed.css')}}" rel="stylesheet">
        <!-- CSS | Responsive media queries -->
        <link href="{{Config::get('app.url')}}/{{ URL::asset('front/assets/dist/css/responsive.css')}}" rel="stylesheet" type="text/css">
        <!-- CSS | Style css. This is the file where you can place your own custom css code. Just uncomment it and use it. -->
        <!-- CSS | Theme Color -->
        <!-- <link href="{{Config::get('app.url')}}/{{ URL::asset('front/assets/dist/css/colors/theme-skin-color-set1.css')}}" rel="stylesheet" type="text/css"> -->
        <!-- external javascripts -->
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> 
        <script src="{{Config::get('app.url')}}/{{ URL::asset('front/jquery.validate.min.js')}}"></script>
        <script src="{{Config::get('app.url')}}/{{ URL::asset('owlcarousel/owl.carousel.js')}}" ></script>
        <script src="{{Config::get('app.url')}}/{{ URL::asset('front/assets/dist/js/jquery.js')}}"></script>
        <script src="{{Config::get('app.url')}}/{{ URL::asset('front/assets/dist/js/bootstrap.min.js')}}" defer></script>
        <script src="{{Config::get('app.url')}}/{{ URL::asset('front/assets/dist/js/javascript-plugins-bundle.js')}}" defer></script>
        <script src="{{Config::get('app.url')}}/{{ URL::asset('front/assets/dist/js/menuzord/js/menuzord.js')}}" ></script>
        <!-- REVOLUTION STYLE SHEETS -->
        <link rel="stylesheet" type="text/css" href="{{Config::get('app.url')}}/{{ URL::asset('front/assets/dist/js/revolution-slider/css/rs6.css')}}">
        <!-- REVOLUTION LAYERS STYLES -->
        <!-- REVOLUTION JS FILES -->
        <script type="text/javascript" src="{{Config::get('app.url')}}/{{ URL::asset('front/assets/dist/js/revolution-slider/js/revolution.tools.min.js')}}" defer></script>
        <script type="text/javascript" src="{{Config::get('app.url')}}/{{ URL::asset('front/assets/dist/js/revolution-slider/js/rs6.min.js')}}" defer></script>
        <?php if(Route::currentRouteName() == 'contact_us' || Route::currentRouteName() == 'service' || Route::currentRouteName() == 'checkout' || Route::currentRouteName() == 'product-detail' || Route::currentRouteName() == 'cart' || Route::currentRouteName() == 'user.profile' ) {?>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css">
        <?php }?>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <script src="https://apps.elfsight.com/p/platform.js" defer></script>
        
        
        @yield('css')
        <!-- ==============================================
        Custom Stylesheet
        =============================================== -->
        
        
