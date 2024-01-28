<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo mr-5" href="#">
          <!-- <img src="{{ asset('assets/images/logo.png') }}" class="mr-2" alt="logo"/> -->
          Tech Labz Ltd
        </a>
        <a class="navbar-brand brand-logo-mini" href="#">
          <!-- <img src="{{ asset('assets/images/logo.png') }}" alt="logo"/> -->
		  TLL
        </a>
    </div>
    <?php $admin = App\Models\User::find(Auth::user()->id) ?>
    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
        <span class="icon-menu"></span>
        </button>
        <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item nav-profile dropdown">
                <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                    <?php if(!empty($admin->image)) { ?>
                    <img src="<?php echo url('/public').'/'.$admin->image; ?>" alt="profile"/>
                    <?php } else {?>
                        <img src="{{ asset('assets/images/faces/face1.jpg') }}" alt="profile"/>
                    <?php }?>
                </a>
                
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                    <a class="dropdown-item" href="{{route('profile')}}">
                        <i class="ti-user text-primary"></i>
                        Profile
                    </a>
                    <a class="dropdown-item" href="{{route('setting')}}">
                        <i class="ti-settings text-primary"></i>
                        Settings
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a class="dropdown-item"  href="route('logout')" onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            <i class="ti-power-off text-primary" ></i>
                            Logout
                        </a>
                    </form>
                </div>
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
        <span class="icon-menu"></span>
        </button>
    </div>
</nav>