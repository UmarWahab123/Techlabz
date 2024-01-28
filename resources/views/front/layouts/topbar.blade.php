<?php $setting = App\Models\Setting::find(1); 

$serL = App\Models\Post::where('status',1)->where('type','main_service')->get();

$brnd = App\Models\Brand::where('status',1)->get();

$service = App\Models\Post::where('slug','repair')->first();

$repair_service = App\Models\Post::where('status',1)->where('type','service')->where('service_id',$service->id)->get();

?>
<style>

.whats-app {
    position: fixed;
    width: 50px;
    height: 50px;
    bottom: 40px;
    background-color: #25d366;
    color: #FFF;
    border-radius: 50px;
    text-align: center;
    font-size: 30px;
    left: 15px;
    z-index: 100;
}

.my-float {
    margin-top: 10px;
}


</style>
<header id="header" class="header header-layout-type-header-2rows">
    <div class="header-top ">
        <div class="container">
            <div class="row">
                <div class="col-xl-auto header-top-left align-self-center text-center text-xl-left">
                    <ul class="element contact-info">
                        <?php if(!empty($setting->header_phone)) {?>
                        <li class="contact-phone d-inline head_menu"><a href="tel:<?php echo $setting->header_phone; ?>" class=""><i class="fa fa-phone font-icon sm-display-block"></i> {{@$setting->header_phone}}</a></li>
                        <?php }?>
                        <?php if(!empty($setting->header_email)) {?>
                        <li class="contact-email  d-inline"><a href="mailto:<?php echo $setting->header_email; ?>" class=""> <i class="fa fa-envelope-o font-icon sm-display-block"></i>{{@$setting->header_email}}</a></li>
                        <?php }?>

                    </ul>
                </div>
                <div class="col-xl-auto ml-xl-auto header-top-right align-self-center text-center text-xl-right">
                    <div class="element">
                        <ul class="header-top-nav list-inline">
                            <li class="menu-item"><a title="Home" class="menu-item-link" href="{{route('cart')}}">Cart <span class="badge badge-light">{{ count((array) session('cart')) }}</span> </a></li>
                            <?php if(!empty(Auth::user())) { ?>
                            <li class="menu-item"><a title="Home" class="menu-item-link" href="{{ route('user.dashboard') }}">Dashboard</a></li>
                            <li class="menu-item">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a class="menu-item-link"  href="route('logout')" onclick="event.preventDefault();
                                                        this.closest('form').submit();">
                                        <i class="ti-power-off text-primary" ></i>
                                        Logout
                                    </a>
                                </form>
                            </li>

                            <?php } else {?>
                                <li class="menu-item"><a title="Home" class="menu-item-link" href="{{ route('login') }}">My Account</a></li>
                            <?php }?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-nav">
        <div class="header-nav-wrapper navbar-scrolltofixed green">
            <div class="menuzord-container header-nav-container green ">
                <div class="container position-relative">
                    <div class="row">
                        <div class="col">
                            <div class="row header-nav-col-row">
                                <div class="col-sm-auto align-self-center">
                                    <a class="menuzord-brand site-brand" href="<?php echo route('homepage'); ?>">
                                    <?php if(!empty($setting->logo)) { ?>
                                        <img class="logo-default logo-1x" src="<?php echo url('/public').'/'.$setting->logo; ?>" alt="Logo">
                                        <img class="logo-default logo-2x retina" src="<?php echo url('/public').'/'.$setting->logo; ?>" alt="Logo">
                                    
                                    <?php }  else {?>
                                        <img class="logo-default logo-1x" src="<?php echo Config::get('app.url'); ?>/{{ URL::asset('assets/logo.webp')}}" alt="Logo">
                                        <img class="logo-default logo-2x retina" src="<?php echo Config::get('app.url'); ?>/{{ URL::asset('assets/logo.webp')}}" alt="Logo">
                                        <?php }?>
                                    </a>
                                </div>
                                <div class="col-sm-auto ml-auto pr-0 align-self-center">
                                    <nav id="top-primary-nav" class="menuzord green" data-effect="fade" data-animation="none" data-align="right">
                                        <ul id="main-nav" class="menuzord-menu">
                                            <li class="<?php if(Route::currentRouteName() == 'homepage' || Route::currentRouteName() == '') {echo 'active'; } ?>"><a href="<?php echo route('homepage'); ?>">{{@$setting->header_home_menu}}</a></li>
                                            
                                            <li class="<?php if(Route::currentRouteName() == 'service') {echo 'active'; } ?>"><a href="#">Repair Services</a>
                                                <ul class="dropdown">
                                                    <?php if($repair_service->count() > 0) { 
                                                        foreach ($repair_service as $key => $val) {
                                                        ?>
                                                        <li><a href="<?php echo route('service', ['slug' => $val->slug]); ?>">{{$val->title}}</a></li>
                                                    <?php } }?>
                                                </ul>
                                            </li>
                                            <li ><a href="<?php echo route('service', ['slug' => 'sales']); ?>">Sales</a></li>

                                            <!-- <li class="<?php if(Route::currentRouteName() == 'service' || Route::currentRouteName() == 'brand') {echo 'active'; } ?>"><a href="<?php echo route('service'); ?>">{{@$setting->header_service_menu}}</a>

                                                <?php if($serL->count() > 0) { ?>
                                                    <ul class="dropdown">
                                                        <?php foreach ($serL as $key => $vali) { ?>
                                                            <li><a href="<?php echo route('service', ['slug' => $vali->slug]); ?>">{{$vali->title}}</a></li>
                                                        <?php }?>
                                                    </ul>
                                                <?php } ?>
                                            </li> -->
                                            
                                            <li class=""><a href="https://www.techlabz.uk/brand/mini-pc">Mini PC's</a>
                                                <?php if($brnd->count() > 0) { ?>
                                                    <ul class="dropdown">
                                                        <?php foreach ($brnd as $key => $vali) { ?>
                                                            <li><a href="<?php echo route('product', ['brand' => $vali->slug,'slug' => 'mini-pc']); ?>">{{$vali->title}}</a></li>
                                                        <?php }?>
                                                    </ul>
                                                <?php } ?>
                                            </li>
                                            <li class="<?php if(Route::currentRouteName() == 'about_us') {echo 'active'; } ?>"><a href="<?php echo route('about_us'); ?>">{{@$setting->header_about_menu}}</a></li>
                                            <li class="<?php if(Route::currentRouteName() == 'blogpost' || Route::currentRouteName() == 'blogpostCategory' || Route::currentRouteName() == 'postdetail') {echo 'active'; } ?>"><a href="<?php echo route('blogpost'); ?>">{{@$setting->header_blog_menu}}</a></li>
                                            
                                            <li class="<?php if(Route::currentRouteName() == 'contact_us') {echo 'active'; } ?>"><a href="<?php echo route('contact_us'); ?>">{{@$setting->header_contact_menu}}</a></li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                            <div class="row d-block d-xl-none">
                                <div class="col-12">
                                    <nav id="top-primary-nav-clone" class="menuzord d-block d-xl-none default menuzord-color-default menuzord-border-boxed menuzord-responsive" data-effect="slide" data-animation="none" data-align="right">
                                        <ul id="main-nav-clone" class="menuzord-menu menuzord-right menuzord-indented scrollable">
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>