<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
 
   
    <title>Home | Tech Labz</title>
</head>

<body>
@extends('front.layouts.master')

@section('css')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw==" crossorigin="anonymous" />
    <!-- <link rel="stylesheet" type="text/css" href="css/style.css"> -->
    <link href="{{Config::get('app.url')}}/{{ URL::asset('new-frontend/css/style.css')}}" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css2?family=Open Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
@endsection
@section('content')
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
          <div class="col-md-4">
         </div>
          <div class="col-md-4">
            <div class="tophead-social">
              <ul>
                <li><a class="btn btn-block btn-social btn-facebook" href=""><span class="fa fa-facebook"></span></a></li>
                <li><a class="btn btn-block btn-social btn-twitter" href=""><span class="fa fa-twitter"></span></a></li>
                <li><a class="btn btn-block btn-social btn-instagram" href=""><span class="fa fa-instagram"></span></a></li>
                <li><a class="btn btn-block btn-social btn-linkedin" href=""><span class="fa fa-linkedin"></span></a></li>
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
            
                    <li class="dropdown nav-item">
                      <a href="#" class="dropdown-toggle nav-link <?php if(Route::currentRouteName() == 'service') {echo 'active'; } ?>" data-toggle="dropdown" role="button" aria-expanded="false">Repair Services<span class="caret"></span></a>
                      <ul class="dropdown-menu" role="menu">
                      <?php if($repair_service->count() > 0) { 
                          foreach ($repair_service as $key => $val) {
                          ?>
                        <li><a href="<?php echo route('service', ['slug' => $val->slug]); ?>">{{$val->title}}</a></li>
                        <?php } }?>
                      </ul>
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
  <!-- End Navbar -->
  <!-- slider section start -->
  <div class="slider-section">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <div class="header-text">
            <h1><span style="color: #25c2e9;">Trusted Laptop & Computer</span> Repair Services</h1>
            <p style="margin-top: 10px;">Tech Labz is one of the leading local computer shop in bolton, UK. Offer all type of laptop & computer repair and sale services at best Prices.</p> <p style="margin-top: 10px;">We did not limit to laptop repair services, but you can avail best deals & offers at Mini Desktop PCs, Computers, Laptops both use and brand new of any make, model, and brand. Get a free Quote Now</p>
          </div>
          <div class="head-btn">
            <a href="https://wa.me/443337729109" target="_blank"><button class="headbtn">Chat on WhatsApp</button></a>
            <a href="<?php echo route('contact_us'); ?>" target="_blank"> <button class="ctnbtn">Contact Us</button></a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- end slider section -->
  <div class="grid-section">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-3">
          <div class="colb-bg">
            <div class="colab-text">
              <h2>Laptop Repair Services </h2>
              <p> Avail best laptop repair services in Bolton UK. We have certified laptop repair team which can repair any make, model, and brand using latest tools and softwares. Book your laptop repair services now.</p>
            </div>
            <div class="colb-btn">
              <?php if($repair_service->count() > 0) { 
                foreach ($repair_service as $key => $val) {
                ?>
                <?php if($val->slug =="laptop-repair" ){ ?>
                <a href="<?php echo route('service', ['slug' => $val->slug]); ?>" target="_blank"><button type="button" class="btn btn-light">Get your Laptop Repair</button></a>
                <?php } ?>
              <?php } }?>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="colbd-bg">
            <div class="colab-text">
              <h2>Desktop Computer Repair</h2>
              <p>Hire specialized desktop compuer repair technicians near you – at your doorstep. We offer all types of desktop computer repair services in Bolton, UK. Upgrade & downgrade your your PC's now</p>
            </div>
            <div class="colb-btn">
              <a href="<?php echo route('contact_us'); ?>" target="_blank"><button type="button" class="btn btn-light">Desktop PCs Repair</button></a>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="colb-bg">
            <div class="colab-text">
              <h2>Surface Pro Repair</h2>
              <p>Get your Microsoft Surface Pro repair with leading computer shop in Bolton at best price. Our surface pro repair team can fully resolve any software and hardware issue - For more Detials</p>
            </div>
            <div class="colb-btn">
            <?php if($repair_service->count() > 0) { 
                foreach ($repair_service as $key => $val) {
                ?>
                <?php if($val->slug =="microsoft-surface-pro-repairs" ){ ?>
                <a href="<?php echo route('service', ['slug' => $val->slug]); ?>" target="_blank"><button type="button" class="btn btn-light">Surface Pro Repair</button></a>
                <?php } ?>
              <?php } }?>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="colbd-bg">
            <div class="colab-text">
              <h2>Mini Desktop PCs Repair </h2>
              <p>Techa Labz - offer mini pcs repair services for any make, model, and brand. We can able to repair, upgrade, downgrade, and setup your simple mini pcs or gaming pcs - Book your Repair services</p>
            </div>
            <div class="colb-btn">
              <a href="<?php echo route('contact_us'); ?>" target="_blank"><button type="button" class="btn btn-light">Mini PCs Repair</button></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- start services section -->
  <div class="ser-section">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="d-flex justify-content-between">
            <div class="ser-text">
              <h3>Our Repair & Sale Services</h3>
            </div>
            <div class="btn-ser">
              <a href="<?php echo route('service'); ?>" target="_blank"><button class="servbtn"> Repair & Sale Services</button></a>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="col-ser"> 
            <div class="ser-col">
              <div class="ser-img">
                <img src="<?php echo url('/public').'/'.'new-frontend/images/Services Icon 6.png' ?>" id="serimg">
              </div>
              <div class="sercol-text">
                <h4><b>Home Computer Repairs</b></h4>
              </div>
            </div>
            <div class="sercol-text">
              <p>We offer full home computer repair services - book and avail computer repair services at your doorstep.</p>
            </div>
            <div class="sercol-text">
              <ul>
                <li>Troubleshooting</li>
                <li>Data Recovery</li>
                <li>Software Installation</li>
                <li>Operating System Installation</li>
                <li>Virus, Spyware, and Malware Removal</li>
                <li>Hardware Repair and Replacement</li>
                <li>Computer Optimization and Maintenance</li>
                <li>Backup and Restore Solutions</li>
              </ul>
            </div>
            <div class="rep-btn">
              <a href="<?php echo route('contact_us'); ?>" target="_blank"><button class="repbtn">Contact - Home Computer Repair</button></a>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="col-ser"> 
            <div class="ser-col">
              <div class="ser-img">
                <img src="<?php echo url('/public').'/'.'new-frontend/images/Services Icon 5.png' ?>" id="serimg">
              </div>
              <div class="sercol-text">
                <h4><b>Business IT Support Services</b></h4>
              </div>
            </div>
            <div class="sercol-text">
              <p>Get the best Business IT support services - to run your business smoothly and optimaly - What we offer check!</p>
            </div>
            <div class="sercol-text">
              <ul>
                <li>Server Setup and Configuration</li>
                <li>Data Backup and Disaster Recovery</li>
                <li>Managed IT Services</li>
                <li>System Monitoring and Maintenance</li>
                <li>Office 365 and Email Solutions</li>
                <li>IT Consultancy</li>
                <li>Remote Support</li>
                <li>Hardware and Software Procurement</li>
              </ul>
            </div>
            <div class="rep-btn">
              <a href="<?php echo route('contact_us'); ?>" target="_blank"><button class="repbtn">Get a Free Quote for IT Support Services</button></a>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="col-ser"> 
            <div class="ser-col">
              <div class="ser-img">
                <img src="<?php echo url('/public').'/'.'new-frontend/images/Services Icon 4.png' ?>" id="serimg">
              </div>
              <div class="sercol-text">
                <h4><b>Built PCs</h4></b>
              </div>
            </div>
            <div class="sercol-text">
              <p>At our computer shop - Along with reapir services you can also built custom Pcs for gaming, home, business, etc</p>
            </div>
            <div class="sercol-text">
              <ul>
                <li>Customized PC Building</li>
                <li>Customized PC Upgrades</li>
                <li>Diagnostic Testing and Repair</li>
                <li>Data Backup and Recovery Solutions</li>
                <li>Professional Networking Services</li>
                <li>Professional System Configuration</li>
                <li>Software and Hardware Installation</li>
                <li>Customized PC Maintenance Plans</li>
              </ul>
            </div>
            <div class="rep-btn">
              <a href="<?php echo route('contact_us'); ?>" target="_blank"><button class="repbtn">Built Your Custom PC Now</button></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="ser-section">
    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <div class="col-ser"> 
            <div class="ser-col">
              <div class="ser-img">
                <img src="<?php echo url('/public').'/'.'new-frontend/images/Services Icon 3.png' ?>" id="serimg">
              </div>
              <div class="sercol-text">
                <h4><b>Remote IT Support</b></h4>
              </div>
            </div>
            <div class="sercol-text">
              <p>If you are unable to visit our computer repair shop in Bolton, You can schedule remote it support.</p>
            </div>
            <div class="sercol-text">
              <ul>
                <li>Network Setup & Management</li>
                <li>Hardware Troubleshooting & Installation</li>
                <li>Software Troubleshooting & Installation</li>
                <li>Security & Backup Solutions</li>
                <li>Data Recovery Services</li>
                <li>Email Services & Support</li>
                <li>Printer Setup & Support</li>
                <li>Virtualization Solutions</li>
              </ul>
            </div>
            <div class="rep-btn">
              <a href="<?php echo route('contact_us'); ?>" target="_blank"><button class="repbtn">Schedule Remote IT Support</button></a>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="col-ser"> 
            <div class="ser-col">
              <div class="ser-img">
                <img src="<?php echo url('/public').'/'.'new-frontend/images/Services Icon 2.png' ?>" id="serimg">
              </div>
              <div class="sercol-text">
                <h4><b>Apple Support & Repairs</b></h4>
              </div>
            </div>
            <div class="sercol-text">
              <p>We are one of the leading Apple support & repair services provider in the Bolton Uk, What we offer!</p>
            </div>
            <div class="sercol-text">
              <ul>
                <li>AppleCare protection plan</li>
                <li>Battery replacement</li>
                <li>Screen Repair</li>
                <li>Memory Upgrade</li>
                <li>Hard Drive Replacement</li>
                <li>Keyboard & Trackpad Replacement</li>
                <li>Software Installation & Updates</li>
                <li>iCloud Setup & Troubleshooting</li>
              </ul>
            </div>
            <div class="rep-btn">
              <a href="<?php echo route('contact_us'); ?>" target="_blank"><button class="repbtn">Get Apple Repair Services</button></a>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="col-ser"> 
            <div class="ser-col">
              <div class="ser-img">
                <img src="<?php echo url('/public').'/'.'new-frontend/images/Services Icon 1.png' ?>" id="serimg">
              </div>
              <div class="sercol-text">
                <h4><b>Mini Desktop PCs Sale</b></h4>
              </div>
            </div>
            <div class="sercol-text">
              <p>Tech Labz leading Mini PCs sales & Repair services provider in Bolton, UK of any make, model, & brands.</p>
            </div>
            <div class="sercol-text">
              <ul>
                <li>Dell Mini PCs</li>
                <li>HP Mini Pcs</li>
                <li>Lenovo Tiny PCs</li>
                <li>Acer Veriton</li>
                <li>ASUS Chromebox</li>
                <li>Apple Mac Mini</li>
                <li>Dell Wyse</li>
                <li>Mini PCs Repair</li>
              </ul>
            </div>
            <div class="rep-btn">
              <a href="https://www.techlabz.uk/brand/mini-pc" target="_blank"><button class="repbtn">Contact - Mini PCs Sale & Repair</button></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- start request an appointment section -->
  <div class="request-section">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <div class="req-text">
            <h3>Request for Sale & Repair Services</h3>
            <p></p>
          </div>
        </div>
        <form class="form form-vertical" id="add_company" method="post">
         @csrf
        <div class="row">
        
          <div class="col-md-6">
            <div class="labelem mt-3">
              <label for="textdate" class="labeltext"> Your Name</label>
              <input type="text" id="text" name="name" placeholder="Enter Your Name" class="inputsec">
            </div>
          </div>
          <div class="col-md-6">
            <div class="labelem mt-3">
              <label for="textdate" class="labeltext"> Your Email</label>
              <input type="email" id="text" name="email" placeholder="Enter You Email" class="inputsec">
            </div>
          </div>
          <div class="col-md-6">
            <div class="labelem mt-3">
              <label for="textdate" class="labeltext"> Your Message</label>
              <input type="text" id="text" name="message" placeholder="Describe Your Problem" class="inputsec">
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="mt-4">
            <button type="submit" class="btn btn-lg btn-light" id="add_company_button">Send Mesage</button>
          </div>
        </div>
      </div>
      </form>
    </div>
  </div>

  <!-- start why choos us section -->
  <div class="choosus-section">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <div class="chous-text">
            <h3>WHY CHOOSE TECH LABZ?</h3>
            <p>The reason to choose your local computer shop in Bolton, Uk. As you can get all type of repair services for your computer, laptop, MacBook, iPad, mobiles, Mini PCs. Not just repair sercices but also sales at the best price around.</p>
          </div>
          <div class="d-flex choosuscol">
            <div class="choimg">
              <img src="<?php echo url('/public').'/'.'new-frontend/images/ic1.png' ?>" alt="" id="cho-img">
            </div>
            <div class="cho-text">
              <h4>Experienced, Trusted Team</h4>
              <p>We have well-trained & certified team for any make, model, & brand. </p>
            </div>
          </div>
          <div class="d-flex choosuscol">
            <div class="choimg">
              <img src="<?php echo url('/public').'/'.'new-frontend/images/ic2.png' ?>" alt="" id="cho-img">
            </div>
            <div class="cho-text">
              <h4>Same Day Repair Available</h4>
              <p>Our team make sure to get repair your laptop, computer at the same day.</p>
            </div>
          </div>
          <div class="d-flex choosuscol">
            <div class="choimg">
              <img src="<?php echo url('/public').'/'.'new-frontend/images/ic3.png' ?>" alt="" id="cho-img">
            </div>
            <div class="cho-text">
              <h4>Competitve Pricing</h4>
              <p>Tech Labz is known low price computer repair shop in the Uk - for all services</p>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="chous-img">
            <img src="<?php echo url('/public').'/'.'new-frontend/images/choo.png' ?>" alt="" id="choimg">
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Start CLIENTS review section -->
  <div class="client-section">
    <div class="container">
      <div class="row">
        <div class="col-md-12 mb-3">
          <div class="client-text">
            <h3>Our Clients Review</h3>
          </div>
        </div>
        <div class="owl-carousel owl-carousel1 owl-theme">
          <div>
            <div class="card text-center">
              <div class="card-body">
                <div class="cli-text">
                  <h5>Rcommended</h5>
                </div>
                <div class="ratings">
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i> 
                </div>
                <div class="cli-text">
                  <p>I have repaired my surface pro screen, i found the staff in computer shop are professional and they charge less as compare to others</p>
                </div>
                <div>
                  <img class="card-img-top" src="<?php echo url('/public').'/'.'new-frontend/images/icon.avif' ?>" alt="">
                </div>
                <div class="cli-text">
                  <p>George</p>
                </div>
              </div>
            </div>
          </div>
          <div>
            <div class="card text-center">
              <div class="card-body">
                <div class="cli-text">
                  <h5>Best Laptop Repair Services</h5>
                </div>
                <div class="ratings">
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i> 
                </div>
                <div class="cli-text">
                  <p>I visit this computer shop whenever I need help with anything tech related. The staff is always friendly, helpful and knowledgeable. They take the time to explain what I need to know and always offer great advice. Highly recommend.</p>
                </div>
                <div>
                  <img class="card-img-top" src="<?php echo url('/public').'/'.'new-frontend/images/icon.avif' ?>" alt="">
                </div>
                <div class="cli-text">
                  <p>Alex</p>
                </div>
              </div>
            </div>
          </div>
          <div>
            <div class="card text-center">
              <div class="card-body">
                <div class="cli-text">
                  <h5>Best Computer Shop</h5>
                </div>
                <div class="ratings">
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i> 
                </div>
                <div class="cli-text">
                  <p>I've been a customer of this computer shop for years and I'm never disappointed. They always have the latest products and the staff is friendly and helpful</p>
                </div>
                <div>
                  <img class="card-img-top" src="<?php echo url('/public').'/'.'new-frontend/images/icon.avif' ?>" alt="">
                </div>
                <div class="cli-text">
                  <p>Amelia</p>
                </div>
              </div>
            </div>
          </div>
          <div>
            <div class="card text-center">
              <div class="card-body">
                <div class="cli-text">
                  <h5>Best Repair Professionals</h5>
                </div>
                <div class="ratings">
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i> 
                </div>
                <div class="cli-text">
                  <p>I recently had the pleasure of visiting this computer shop and I was very impressed with repair services.</p>
                </div>
                <div>
                  <img class="card-img-top" src="<?php echo url('/public').'/'.'new-frontend/images/icon.avif' ?>" alt="">
                </div>
                <div class="cli-text">
                  <p>CEO- Rank Higher</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- start post section -->
  <div class="post-section">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="post-text">
            <h3>OUR LATEST POST</h3>
          </div>
        </div>
        <?php if($blog_post->count() > 0) { 
          foreach ($blog_post as $blog) {
          ?>
        <div class="col-md-4">
          <div class="post-img">
            <img src="<?php echo url('/public').'/'.$blog->image; ?>" alt="" id="postimg">
          </div>
          <div class="d-flex mt-2">
            <div class="postdate">
              <h6>01 Feb</h6>
            </div>
            <div class="post-heading">
              <h4><?php $out = strlen($blog->title) > 55 ? substr($blog->title,0,55)."..." : $blog->title; echo $out;  ?></h4>
              <div class="b-border"></div>
            </div>
          </div>
          <div class="post-text">
            <p>{{$blog->short_description}} </p>
          </div>
          <div class="post-btn">
            <a href="<?php echo route('post', ['slug' => $blog->slug]); ?>"> Read More</a>
          </div>
        </div>
        <?php } } ?>

      </div>
    </div>
  </div>
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
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group mb-2">
                    <input type="text" class="form-control" id="inputText" placeholder="Name">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group mb-2">
                    <input type="email" class="form-control" id="inputEmial" placeholder="Email">
                  </div>
                </div>
                <div class="col-md-4">
                  <a href="https://www.techlabz.uk/contact-us"><button type="submit" class="btn btn-light mb-2">Contact Us</button></a>
                </div>
              </div>
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
  

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  <!-- slider script -->
  <script src="{{Config::get('app.url')}}/{{ URL::asset('new-frontend/js/custom.js')}}"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script>
  var $j = jQuery.noConflict();
  $j(document).ready(function() {
    $j("#add_company").validate();
  });
</script>
  <script>
 
$(function() {
        $("#add_company").validate({
            submitHandler: function() {
                var l = Ladda.create(document.querySelector('#add_company_button'));
                l.start();
                var formData = new FormData($('#add_company')[0]);
                $.ajax({
                    data: formData,
                    type: "POST",
                    url: ajax_url+"/add-service-contact",
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        l.stop();
                        if(response.status) {
                           
                           toastr.success("We Have recieved your message! We will contact you shortly!", '', {
                                "progressBar": true,
                                "positionClass": "toast-top-center",
                                "showDuration": "10000",
  "hideDuration": "10000",
  "timeOut": "10000",
  "extendedTimeOut": "10000",
                            });
                            $('#add_company').trigger("reset");
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
                        l.stop();
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
            }
        });
    });
  </script>
  <!-- <script src="js/custom.js"></script> -->
</body>
</html>