
<?php $service = App\Models\Post::where('slug','repair')->first();

    $repair_service = App\Models\Post::where('status',1)->where('type','service')->where('service_id',$service->id)->get();

    $setting = App\Models\Setting::first();
    $brnd = App\Models\Brand::where('status',1)->get();

?>
<!-- start footer section -->
  <div class="footer-section">
    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <div class="footer-logo">
            <a href="index.html">
              <img src="<?php echo url('/public').'/'.'new-frontend/images/header-logo.png' ?>" alt="">
            </a>
          </div>
          <div class="footer-menu mt-2">
            <ul>
              <li>
                <a href="#"><i class="fa fa-phone" aria-hidden="true" id="foot-icon"></i>+44-333-772-9109</a>
              </li>
              <li>
                <a href="#"><i class="fa fa-envelope" aria-hidden="true" id="foot-icon"></i>hello@techlabz.com</a>
              </li>
              <li>
                <a href="#"><i class="fa fa-map-marker" aria-hidden="true" id="foot-icon"></i>Address: Unit 44, Halliwell Industrial Estate, Rossini St, Bolton, BL1 8DL</a>
              </li>
            </ul>
          </div>
          <div class="footer-social">
            <ul>
              <li><a class="btn btn-block btn-social btn-twitter" href=""><span class="fa fa-twitter"></span></a></li>
              <li><a class="btn btn-block btn-social btn-facebook" href=""><span class="fa fa-facebook"></span></a></li>
              <li><a class="btn btn-block btn-social btn-linkedin" href=""><span class="fa fa-linkedin"></span></a></li>
              <li><a class="btn btn-block btn-social btn-instagram" href=""><span class="fa fa-instagram"></span></a></li>
            </ul>
          </div>
        </div>
        <div class="col-md-8">
          <div class="row">
            <div class="col-md-3">
              <div class="footer-text">
                <h4>Quick Link</h4>
              </div>
              <div class="footer-menu">
                <ul>
                  <li>
                    <a href="<?php echo route('homepage'); ?>"><i class="fa fa-chevron-right" id="foot-icon"></i>Home</a>
                  </li>
                  <li>
                    <a href="<?php echo route('about_us'); ?>"><i class="fa fa-chevron-right" id="foot-icon"></i>About Us</a>
                  </li>
                  <li>
                    <a href="<?php echo route('contact_us'); ?>"><i class="fa fa-chevron-right" id="foot-icon"></i>Contact Us</a>
                  </li>
                  <li>
                    <a href="<?php echo route('blogpost'); ?>"><i class="fa fa-chevron-right" id="foot-icon"></i>Blog</a>
                  </li>
                  <li>
                    <a href="{{route('cart')}}"><i class="fa fa-chevron-right" id="foot-icon"></i>Cart</a>
                  </li>
                </ul>
              </div>
            </div>
            <div class="col-md-4">
              <div class="footer-text">
                <h4>Repair Service</h4>
              </div>
              <div class="footer-menu">
                <ul>
                  <?php if($repair_service->count() > 0) { 
                    foreach ($repair_service as $key => $val) {
                    ?>
                  <li>
                  <a href="<?php echo route('service', ['slug' => $val->slug]); ?>"><i class="fa fa-chevron-right" id="foot-icon"></i>{{$val->title}}</a>
                  <?php } }?>
                  </li>
                </ul>
              </div>
            </div>
            <div class="col-md-5">
              <div class="footer-text">
                <h4>Mini PCs Sale & Repair</h4>
              </div>
              <div class="footer-menu">
                  <ul>
                  <?php foreach ($brnd as $key => $vali) { ?>
                    <li>
                    <a href="<?php echo route('product', ['brand' => $vali->slug,'slug' => 'mini-pc']); ?>"> <i class="fa fa-chevron-right" id="foot-icon"></i>{{$vali->title}} Mini PCs</a>
                    <?php }?>
                  </ul>
              </div>
            </div>
            <div class="col-md-12 mt-3">
            <form id="contact_us" method="post" >
              {{ csrf_field() }}
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group mb-2">
                    <input type="text" name="name" class="form-control" id="inputText" placeholder="Name" required>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group mb-2">
                    <input type="email" name="email" class="form-control" id="inputEmial" placeholder="Email">
                  </div>
                </div>
                <div class="col-md-4">
                <button type="submit" class="btn btn-light mb-2">Contact Us</button>
                </div>
              </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="mt-5">
        <div class="border-t">
          <div class="row">
            <div class="col-md-6">
              <div class="footerb">
                <p>Copyright © 2023 <a href="https://rankhigher.uk/">Rank Higher Ltd</a> All Rights Reserved</p>
              </div>
            </div>
            <div class="col-md-6">
              <div class="foot-menu">
                <ul>
                  <li><a href="#">Term of use</a></li>
                  <li><a href="#">Privacy Policy</a></li>
                  <li><a href="#">Cookie Policy</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  