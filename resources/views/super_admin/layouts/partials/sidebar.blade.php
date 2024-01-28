
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item <?php if(Route::currentRouteName() == 'dashboard') {echo 'active'; } ?>">
            <a class="nav-link" href="{{route('dashboard')}}">
            <i class="icon-grid menu-icon"></i>
            <span class="menu-title">Dashboard</span>
            </a>
        </li>

        <li class="nav-item <?php if(Route::currentRouteName() == 'manage-sales-category' ||Route::currentRouteName() == 'add-sales-category' || Route::currentRouteName() == 'edit-sales-category') {echo 'active'; } ?>">
            <a class="nav-link" data-toggle="collapse" href="#error" aria-expanded="false" aria-controls="error">
              <i class="mdi mdi-cart menu-icon"></i>
              <span class="menu-title">Manage Sales Items</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="error">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{route('manage-sales-category')}}">Sales Sub Category</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{route('manage-brand')}}"> Sales Brands </a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{route('manage-sales-product')}}"> Sales Products </a></li>
                </ul>
            </div>
          </li>
          <li class="nav-item <?php if(Route::currentRouteName() == 'manage-orders') {echo 'active'; } ?>">
            <a class="nav-link " href="{{route('manage-orders')}}">
            <i class="mdi mdi-blogger menu-icon"></i>
            <span class="menu-title">Manage Sales Orders </span>
            </a>
        </li>
        <li class="nav-item <?php if(Route::currentRouteName() == 'manage-post' ||Route::currentRouteName() == 'add-post' || Route::currentRouteName() == 'edit-post') {echo 'active'; } ?>">
            <a class="nav-link " href="{{route('manage-post')}}">
            <i class="mdi mdi-blogger menu-icon"></i>
            <span class="menu-title">Manage Posts </span>
            </a>
        </li>

        <li class="nav-item <?php if(Route::currentRouteName() == 'manage-deals' ||Route::currentRouteName() == 'add-deal') {echo 'active'; } ?>">
            <a class="nav-link " href="{{route('manage-deals')}}">
            <i class="mdi mdi-amazon menu-icon"></i>
            <span class="menu-title">Manage Amazon Deals </span>
            </a>
        </li>


        <li class="nav-item <?php if(Route::currentRouteName() == 'manage-category' || Route::currentRouteName() == 'add-category' || Route::currentRouteName() == 'edit-category') {echo 'active'; } ?>">
            <a class="nav-link " href="{{route('manage-category')}}">
            <i class="mdi mdi-office menu-icon"></i>
            <span class="menu-title">Manage Blog Category </span>
            </a>
        </li>


        <li class="nav-item <?php if(Route::currentRouteName() == 'blog.manage-post' || Route::currentRouteName() == 'blog.add-post' || Route::currentRouteName() == 'blog.edit-post') {echo 'active'; } ?>">
            <a class="nav-link " href="{{route('blog.manage-post')}}">
            <i class="mdi mdi-calendar-text menu-icon"></i>
            <span class="menu-title">Manage Blog </span>
            </a>
        </li>

        <li class="nav-item <?php if(Route::currentRouteName() == 'manage-service') {echo 'active'; } ?>">
            <a class="nav-link " href="{{route('manage-service')}}">
            <i class="mdi mdi-cellphone-settings menu-icon"></i>
            <span class="menu-title">Manage Service </span>
            </a>
        </li>

        <li class="nav-item <?php if(Route::currentRouteName() == 'manage-sub-service') {echo 'active'; } ?>">
            <a class="nav-link " href="{{route('manage-sub-service')}}">
            <i class="mdi mdi-cellphone-settings menu-icon"></i>
            <span class="menu-title">Manage Sub Service </span>
            </a>
        </li>


        <li class="nav-item <?php if(Route::currentRouteName() == 'manage-contact') {echo 'active'; } ?>">
            <a class="nav-link " href="{{route('manage-contact')}}">
            <i class="mdi mdi-tooltip-outline menu-icon"></i>
            <span class="menu-title">Contact Us </span>
            </a>
        </li>


        <li class="nav-item <?php if(Route::currentRouteName() == 'manage-repair-contact') {echo 'active'; } ?>">
            <a class="nav-link " href="{{route('manage-repair-contact')}}">
            <i class="mdi mdi-tooltip-outline menu-icon"></i>
            <span class="menu-title">Service Contact Us </span>
            </a>
        </li>

        <li class="nav-item <?php if(Route::currentRouteName() == 'manage-email-template') {echo 'active'; } ?>">
            <a class="nav-link " href="{{route('manage-email-template')}}">
            <i class="mdi mdi-email menu-icon"></i>
            <span class="menu-title">Email Template </span>
            </a>
        </li>

        <li class="nav-item <?php if(Route::currentRouteName() == 'setting') {echo 'active'; } ?>">
            <a class="nav-link " href="{{route('setting')}}">
            <i class="ti-settings menu-icon"></i>
            <span class="menu-title">Setting </span>
            </a>
        </li>

        <li class="nav-item <?php if(Route::currentRouteName() == 'seo-setting') {echo 'active'; } ?>">
            <a class="nav-link " href="{{route('seo-setting')}}">
            <i class="ti-settings menu-icon"></i>
            <span class="menu-title">SEO Settings</span>
            </a>
        </li>

        <li class="nav-item <?php if(Route::currentRouteName() == 'home-setting') {echo 'active'; } ?>">
            <a class="nav-link " href="{{route('home-setting')}}">
            <i class="ti-settings menu-icon"></i>
            <span class="menu-title">Homepage Settings</span>
            </a>
        </li>

        <li class="nav-item <?php if(Route::currentRouteName() == 'manage-database') {echo 'active'; } ?>">
            <a class="nav-link " href="{{route('manage-database')}}">
            <i class="ti-settings menu-icon"></i>
            <span class="menu-title">Database Backup</span>
            </a>
        </li>


    </ul>
</nav>