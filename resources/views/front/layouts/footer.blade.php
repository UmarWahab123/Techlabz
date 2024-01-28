
<?php $service = App\Models\Post::where('slug','repair')->first();

    $repair_service = App\Models\Post::where('status',1)->where('type','service')->where('service_id',$service->id)->get();

    $setting = App\Models\Setting::first();
    $brnd = App\Models\Brand::where('status',1)->get();

?>

<a  class="whats-app" href="https://api.whatsapp.com/send?phone=443337729109" target="_blank">
    <i class="fa fa-whatsapp my-float"></i>
</a>


<footer id="footer" class="footer">
    <div class="footer-widget-area">
        <div class="container pt-90 pb-60">
            <div class="row">
                <div class="col-md-6 col-lg-6 col-xl-4">
                    <div id="tm_widget_contact_info-1" class="split-nav-menu clearfix widget widget-contact-info clearfix mb-20">
                        <div class="tm-widget tm-widget-contact-info contact-info contact-info-style1  contact-icon-theme-colored1">
                        <img class="logo-default logo-1x" src="<?php echo url('/public').'/'.$setting->logo; ?>" alt="Logo">
                            <div class="description"><br>Address: <?php echo @$setting->address; ?><br> <br>Phone: <?php echo @$setting->phone; ?></div>
                            <div class="description">{{@$setting->site_description}}</div>
                        </div>
                        <div id="tm_widget_social_list_custom-1" class="split-nav-menu clearfix widget widget-social-list-custom clearfix">
							<ul class="tm-widget tm-widget-social-list tm-widget-social-list-custom styled-icons  icon-dark  icon-rounded icon-theme-colored1 ">
								<li><a class="social-link" target="_blank" href="{{@$setting->facebook_link}}"><i class="fa fa-facebook"></i></a></li>
								<li><a class="social-link" target="_blank" href="{{@$setting->twitter_link}}"><i class="fa fa-twitter"></i></a></li>
								<li><a class="social-link" target="_blank" href="{{@$setting->youtube_link}}"><i class="fa fa-youtube"></i></a></li>
								<li><a class="social-link" target="_blank" href="{{@$setting->instagram_link}}"><i class="fa fa-instagram"></i></a></li>
							</ul>
						</div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-2">
                    <div id="nav_menu-1" class="widget widget_nav_menu">
                        <h4 class="widget-title widget-title-line-bottom line-bottom-footer-widget line-bottom-theme-colored1">Quick Link</h4>
                        <div class="menu-service-nav-menu-container">
                            <ul id="menu-service-nav-menu" class="menu">
                                <li class="menu-item menu-item-type-post_type menu-item-object-services menu-item-20545"><a href="<?php echo route('homepage'); ?>">Home</a></li>
                                <li class="menu-item menu-item-type-post_type menu-item-object-services menu-item-20545"><a href="<?php echo route('about_us'); ?>">About Us</a></li>
                                <li class="menu-item menu-item-type-post_type menu-item-object-services menu-item-20545"><a href="<?php echo route('contact_us'); ?>">Contact Us</a></li>
                                <li class="menu-item menu-item-type-post_type menu-item-object-services menu-item-20545"><a href="<?php echo route('blogpost'); ?>">Blog</a></li>
                                <li class="menu-item menu-item-type-post_type menu-item-object-services menu-item-20545"><a href="#">Cart</a></li>
                                
                                
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div id="nav_menu-1" class="widget widget_nav_menu">
                        <h4 class="widget-title widget-title-line-bottom line-bottom-footer-widget line-bottom-theme-colored1">Repair Services</h4>
                        <div class="menu-service-nav-menu-container">
                            <ul id="menu-service-nav-menu" class="menu">
                            <?php if($repair_service->count() > 0) { 
                                foreach ($repair_service as $key => $val) {
                                ?>
                                <li class="menu-item menu-item-type-post_type menu-item-object-services menu-item-20545"><a href="<?php echo route('service', ['slug' => $val->slug]); ?>">{{$val->title}}</a></li>
                            <?php } }?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div id="nav_menu-1" class="widget widget_nav_menu">
                        <h4 class="widget-title widget-title-line-bottom line-bottom-footer-widget line-bottom-theme-colored1">Mini PCs Sale & Repair</h4>
                        <div class="menu-service-nav-menu-container">
                            <ul id="menu-service-nav-menu" class="menu">
                            <?php if($brnd->count() > 0) { 
                                foreach ($brnd as $key => $vali) {
                                ?>
                                <li class="menu-item menu-item-type-post_type menu-item-object-services menu-item-20545"><a href="<?php echo route('product', ['brand' => $vali->slug,'slug' => 'mini-pc']); ?>">{{$vali->title}} Mini-Micro PCs</a></li>
                            <?php } }?>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- <div class="col-md-6 col-lg-6 col-xl-3">
                    <div id="tm_widget_opening_hours_compressed-1" class="split-nav-menu clearfix widget widget-opening-hours-compressed clearfix">
                        <h4 class="widget-title widget-title-line-bottom line-bottom-footer-widget line-bottom-theme-colored1">Opening Hours</h4>
                        <ul class="tm-widget tm-widget-opening-hours tm-widget-opening-hours-compressed opening-hours border-dark">
                            <li class="clearfix">
                                <span>Monday</span>
                                <div class="value">{{$setting->monday}}</div>
                            </li>
                            <li class="clearfix">
                                <span>Tuesday</span>
                                <div class="value">{{$setting->tuesday}}</div>
                            </li>
                            <li class="clearfix">
                                <span>Wednesday</span>
                                <div class="value">{{$setting->wednesday}}</div>
                            </li>
                            <li class="clearfix">
                                <span>Thursday</span>
                                <div class="value">{{$setting->thursday}}</div>
                            </li>
                            <li class="clearfix">
                                <span>Friday</span>
                                <div class="value">{{$setting->friday}}</div>
                            </li>
                            <li class="clearfix">
                                <span>Saturday</span>
                                <div class="value">{{$setting->saturday}}</div>
                            </li>
                            <li class="clearfix">
                                <span>Sunday</span>
                                <div class="value">{{$setting->sunday}}</div>
                            </li>
                        </ul>
                    </div>
                </div> -->
            </div>
        </div>
        <div class="footer-bottom" data-tm-bg-color="#2A2A2A">
            <div class="container">
                <div class="row pt-20 pb-20">
                    <div class="col-sm-6">
                        <div class="footer-paragraph">
                            <?php echo $setting->footer_copyright_text; ?>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="footer-paragraph text-right">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<a class="scrollToTop" href="#"><i class="fa fa-angle-up"></i></a>