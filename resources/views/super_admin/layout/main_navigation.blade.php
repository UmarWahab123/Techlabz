<!-- BEGIN: Main Menu-->

<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">

    <div class="navbar-header">

        <ul class="nav navbar-nav flex-row">

            <li class="nav-item mr-auto"><a class="navbar-brand" href="{{ url('/') }}"><span class="brand-logo">

                <img class="latest-logo" src="https://logos.flamingtext.com/Word-Logos/test-design-sketch-name.png" alt="Maxhype" width="150" height="30" ></span>

                    <h2 class="brand-text"></h2>

                </a></li>

            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i></a></li>

        </ul>

    </div>

    <div class="shadow-bottom"></div>

    <div class="main-menu-content">

        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

            <li class="nav-item dashboard"><a class="d-flex align-items-center" href="{{url('admin/home')}}"><i data-feather="home"></i><span class="menu-title text-truncate">Dashboard</span></a>

            <li class="nav-item manage-posts"><a class="d-flex align-items-center" href="{{route('manage-post')}}"><i data-feather="post"></i><span class="menu-title text-truncate">Manage Posts</span></a>

            <li class="nav-item"><a class="d-flex align-items-center usermgt" href="#"><i data-feather="users"></i><span class="menu-title text-truncate">User Managemnet</span></a>

                <ul class="menu-content dfdsfsd">

                    <li class="roles"><a class="d-flex align-items-center" href="{{ url('admin/roles') }}"><i data-feather="circle"></i><span class="menu-item text-truncate">Roles</span></a>

                    </li>

                    <li class="users"><a class="d-flex align-items-center" href="{{ url('admin/users') }}"><i data-feather="circle"></i><span class="menu-item text-truncate">User List</span></a>

                    </li>

                </ul>

            </li>

             <li class="nav-item"><a class="d-flex align-items-center locations" href="#"><i data-feather="codepen"></i><span class="menu-title text-truncate">Location Management</span></a>

                <ul class="menu-content dfdsfsd">

                    <li class="view-location"><a class="d-flex align-items-center" href="{{ url('admin/loction') }}"><i data-feather="circle"></i><span class="menu-item text-truncate">All Locations</span></a>

                    </li>

                    <li class="view-country"><a class="d-flex align-items-center" href="{{ url('admin/country') }}"><i data-feather="circle"></i><span class="menu-item text-truncate">All Added Country</span></a>

                    </li>

                </ul>

            </li>

              <li class="nav-item"><a class="d-flex align-items-center business-mgt" href="#"><i data-feather="codepen"></i><span class="menu-title text-truncate">Business Managemnet</span></a>

                <ul class="menu-content dfdsfsd">

                    <li class="add-Business"><a class="d-flex align-items-center" href="{{ url('admin/businesses') }}"><i data-feather="circle"></i><span class="menu-item text-truncate">Add A Business</span></a>

                    </li>

                    <li class="view-business"><a class="d-flex align-items-center" href="{{ url('admin/business') }}"><i data-feather="circle"></i><span class="menu-item text-truncate">All Businesses</span></a>

                    </li>

                    <li class="reserve-business"><a class="d-flex align-items-center" href="{{ url('admin/reserved') }}"><i data-feather="circle"></i><span class="menu-item text-truncate">Reservation</span></a>

                    </li>

                     <li class="purchase-business"><a class="d-flex align-items-center" href="{{ url('admin/purchased') }}"><i data-feather="circle"></i><span class="menu-item text-truncate">Purchase</span></a>

                    </li>

                    <li class="videos"><a class="d-flex align-items-center" href="{{ url('admin/video') }}"><i data-feather="circle"></i><span class="menu-item text-truncate">User Videos</span></a>

                    </li>

                </ul>

            </li>

             <li class="nav-item"><a class="d-flex align-items-center business-request" href="#"><i data-feather="codepen"></i><span class="menu-title text-truncate">Business Requests</span></a>

                <ul class="menu-content dfdsfsd">

                    <li class="accepted"><a class="d-flex align-items-center" href="{{ url('admin/accepted') }}"><i data-feather="circle"></i><span class="menu-item text-truncate">Accepted Requests</span></a>

                    </li>

                    <li class="rejected"><a class="d-flex align-items-center" href="{{ url('admin/rejected') }}"><i data-feather="circle"></i><span class="menu-item text-truncate">Rejected Requests</span></a>

                    </li>

                    <li class="pending"><a class="d-flex align-items-center" href="{{ url('admin/pending') }}"><i data-feather="circle"></i><span class="menu-item text-truncate">Pending Requests</span></a>

                    </li>

                </ul>

            </li>

               <li class="nav-item all_owners"><a class="d-flex align-items-center business_owner" href="{{ url('admin/business_owners') }}"><i data-feather="user-plus"></i><span class="menu-title text-truncate">Business Owners</span></a>

            </li>
             
            <li class="nav-item"><a class="d-flex align-items-center bookings" href="#"><i data-feather="layers"></i><span class="menu-title text-truncate">Memberships</span></a>

                <ul class="menu-content dfdsfsd">

                    <li class="all-bookings"><a class="d-flex align-items-center" href="{{ url('admin/booking') }}"><i data-feather="circle"></i><span class="menu-item text-truncate">All Bookings</span></a>

                    </li>

                    <li class="all-memberships"><a class="d-flex align-items-center" href="{{ url('admin/membership') }}"><i data-feather="circle"></i><span class="menu-item text-truncate">All Memberships</span></a>

                    </li>

                 </ul>

             </li>
            <li class="nav-item"><a class="d-flex align-items-center vehicles" href="#"><i data-feather="move"></i><span class="menu-title text-truncate">Vehicles</span></a>

                <ul class="menu-content dfdsfsd">

                    <li class="add-vehicles"><a class="d-flex align-items-center" href="{{ url('admin/vehicles') }}"><i data-feather="circle"></i><span class="menu-item text-truncate">Add Vehicle Category</span></a>

                    </li>

                    <li class="view-vehicles"><a class="d-flex align-items-center" href="{{ url('admin/vehicle') }}"><i data-feather="circle"></i><span class="menu-item text-truncate">All Vehicles Category</span></a>

                    </li>

                </ul>

            </li>
            
            <li class="nav-item"><a class="d-flex align-items-center packages" href="#"><i data-feather="package"></i><span class="menu-title text-truncate">Packages</span></a>

                <ul class="menu-content dfdsfsd">

                    <li class="add-package"><a class="d-flex align-items-center" href="{{ url('admin/packages') }}"><i data-feather="circle"></i><span class="menu-item text-truncate">Add Package</span></a>

                    </li>

                    <li class="view-package"><a class="d-flex align-items-center" href="{{ url('admin/package') }}"><i data-feather="circle"></i><span class="menu-item text-truncate">All Packages</span></a>

                    </li>

                </ul>

            </li>

            <li class="nav-item"><a class="d-flex align-items-center customers" href="#"><i data-feather="user-plus"></i><span class="menu-title text-truncate">Customers</span></a>

                <ul class="menu-content dfdsfsd">

                    <li class="add-customer"><a class="d-flex align-items-center" href="{{ url('admin/customers') }}"><i data-feather="circle"></i><span class="menu-item text-truncate">Add Customer</span></a>

                    </li>

                    <li class="view-customer"><a class="d-flex align-items-center" href="{{ url('admin/customer') }}"><i data-feather="circle"></i><span class="menu-item text-truncate">All Customer</span></a>

                    </li>

                </ul>

            </li>

              <li class="nav-item"><a class="d-flex align-items-center affiliates" href="#"><i data-feather="user-plus"></i><span class="menu-title text-truncate">Affiliate</span></a>

                <ul class="menu-content dfdsfsd">

                    <li class="add-affiliate"><a class="d-flex align-items-center" href="{{ url('admin/affiliates') }}"><i data-feather="circle"></i><span class="menu-item text-truncate">Add Affiliate Users</span></a>

                    </li>

                    <li class="view-affiliate"><a class="d-flex align-items-center" href="{{ url('admin/affiliate') }}"><i data-feather="circle"></i><span class="menu-item text-truncate">All Affiliate Users</span></a>

                    </li>

                </ul>

            </li>

               <li class="nav-item"><a class="d-flex align-items-center careers" href="#"><i data-feather="radio"></i><span class="menu-title text-truncate">Careers</span></a>

                <ul class="menu-content dfdsfsd">

                    <li class="add-position"><a class="d-flex align-items-center" href="{{ url('admin/position') }}"><i data-feather="circle"></i><span class="menu-item text-truncate">Careers Positions</span></a>

                    </li>

                    <li class="post-job"><a class="d-flex align-items-center" href="{{ url('admin/careers') }}"><i data-feather="circle"></i><span class="menu-item text-truncate">Post A Job</span></a>

                    </li>

                    <li class="all-job"><a class="d-flex align-items-center" href="{{ url('admin/career') }}"><i data-feather="circle"></i><span class="menu-item text-truncate">All Posted Job</span></a>

                    </li>

                </ul>

            </li>


             <li class="nav-item usermessage"><a class="d-flex align-items-center" href="{{ url('admin/usermessages') }}"><i data-feather="message-square"></i><span class="menu-title text-truncate">User Messages</span></a>


             </li>

            <li class=" nav-item settings"><a class="d-flex align-items-center" href="{{url('admin/settings')}}"><i data-feather='settings'></i><span class="menu-title text-truncate">Settings</span></a>

            </li>

        </ul>

    </div>

</div>

<!-- END: Main Menu-->

