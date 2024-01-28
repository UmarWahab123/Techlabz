<?php $setting = App\Models\Setting::find(1); 

$serL = App\Models\Post::where('status',1)->where('type','main_service')->get();

$brnd = App\Models\Brand::where('status',1)->get();

$service = App\Models\Post::where('slug','repair')->first();

$repair_service = App\Models\Post::where('status',1)->where('type','service')->where('service_id',$service->id)->get();

?>
 <!-- Start Navbar -->
  <div class="paraxdo-header-section">
    <div class="paraxdotop-header">
      <div class="container">
        <div class="row">
          <div class="col-md-2">
            <div class="tophead-text">
              <span><i class="fa fa-phone"></i>+44-333-772-9109</span>
            </div>
          </div>
          <div class="col-md-2">
            <div class="tophead-text">
              <span> <i class="fa fa-envelope"></i>Hello@techlabz.com</span>
            </div>
          </div>
          <div class="col-md-4"></div>
          <div class="col-md-4">
            <div class="element">
              <ul class="header-top-nav list-inline">
                <li class="menu-item">
                  <a title="Home" class="menu-item-link" href="{{route('cart')}}">Cart <span class="badge badge-light">{{ count((array) session('cart')) }}</span> </a>
                </li>
                <?php if(!empty(Auth::user())) { ?>
                <li class="menu-item">
                  <a title="Home" class="menu-item-link" href="#">Dashboard</a>
                </li>
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
                <!-- <li class="menu-item">
                  <a title="Home" class="menu-item-link" href="#">Logout</a>
                </li> -->
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row">
          <div class="paraxdo-header-img">
            <nav class="navbar sticky-top navbar-expand-lg bg-dark">
              <div class="container">
                <a  class="navbar-brand" href="<?php echo route('homepage'); ?>">
                  <img src="<?php echo url('/public').'/'.'new-frontend/images/header-logo.png' ?>" id="logsedf" alt="">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <i class="fa fa-bars" aria-hidden="true"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <ul class="navbar-nav">
                    <li class="nav-item">
                      <a class="nav-link active <?php if(Route::currentRouteName() == 'homepage' || Route::currentRouteName() == '') {echo 'active'; } ?>" id="home-col" href="<?php echo route('homepage'); ?>">Home</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link"  href="{{url('/repair-services')}}" class="dropdown-toggle nav-link <?php if(Route::currentRouteName() == 'repair_services_category') {echo 'active'; } ?>">Repair Services</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link"  href="<?php echo route('service', ['slug' => 'sales']); ?>">Sales</a>
                    </li>
                    <li class="dropdown nav-item">
                      <a href="https://www.techlabz.uk/brand/mini-pc" class="dropdown-toggle nav-link" data-toggle="dropdown" role="button" aria-expanded="false">Mini PC’s<span class="caret"></span></a>
                      <?php if($brnd->count() > 0) { ?>
                      <ul class="dropdown-menu" role="menu">
                      <?php foreach ($brnd as $key => $vali) { ?>
                        <li><a href="<?php echo route('product', ['brand' => $vali->slug,'slug' => 'mini-pc']); ?>">{{$vali->title}}</a></li>
                        <?php }?>
                      </ul>
                      <?php } ?>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link <?php if(Route::currentRouteName() == 'about_us') {echo 'active'; } ?>"  href="<?php echo route('about_us'); ?>">{{@$setting->header_about_menu}}</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link <?php if(Route::currentRouteName() == 'blogpost' || Route::currentRouteName() == 'blogpostCategory' || Route::currentRouteName() == 'postdetail') {echo 'active'; } ?>"  href="<?php echo route('blogpost'); ?>">{{@$setting->header_blog_menu}}</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link"  href="<?php echo route('contact_us'); ?>">{{@$setting->header_contact_menu}}</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link"  href="#" id="redbtn">REGISTER NOW</a>
                    </li>
                  </ul>
                </div>
              </div>
            </nav>
          </div>
      </div>
    </div>
  </div>