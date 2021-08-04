<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Adminox - Responsive Web App Kit</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- C3 charts css -->
        <link href="../plugins/c3/c3.min.css" rel="stylesheet" type="text/css"  />

        <!-- App css -->
        <link href="{{ asset('assets/css/bootstrap.min.css ') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/icons.css ') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/metismenu.min.css ') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/style.css ') }}" rel="stylesheet" type="text/css" />

        <script src="{{ asset('assets/js/modernizr.min.js ') }}"></script>

    </head>


    <body>

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Top Bar Start -->
            <div class="topbar">

                <!-- LOGO -->
                <div class="topbar-left">
                    <a href="index.html" class="logo">
                                <span>
                                    <img src="{{ asset('assets/images/logo.png') }}" alt="" height="25">
                                </span>
                        <i>
                            <img src="{{ asset('assets/images/logo_sm.png') }}" alt="" height="28">
                        </i>
                    </a>
                </div>

                <nav class="navbar-custom">

                    <ul class="list-inline float-right mb-0">
                        <li class="list-inline-item dropdown notification-list">
                            <a class="nav-link dropdown-toggle arrow-none waves-light waves-effect" data-toggle="dropdown" href="#" role="button"
                               aria-haspopup="false" aria-expanded="false">
                                <i class="dripicons-bell noti-icon"></i>
                                <span class="badge badge-pink noti-icon-badge">4</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-arrow dropdown-lg" aria-labelledby="Preview">
                                <!-- item-->
                                <div class="dropdown-item noti-title">
                                    <h5><span class="badge badge-danger float-right">5</span>Notification</h5>
                                </div>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <div class="notify-icon bg-success"><i class="icon-bubble"></i></div>
                                    <p class="notify-details">Robert S. Taylor commented on Admin<small class="text-muted">1 min ago</small></p>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <div class="notify-icon bg-info"><i class="icon-user"></i></div>
                                    <p class="notify-details">New user registered.<small class="text-muted">1 min ago</small></p>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <div class="notify-icon bg-danger"><i class="icon-like"></i></div>
                                    <p class="notify-details">Carlos Crouch liked <b>Admin</b><small class="text-muted">1 min ago</small></p>
                                </a>

                                <!-- All-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item notify-all">
                                    View All
                                </a>

                            </div>
                        </li>

                        <li class="list-inline-item dropdown notification-list">
                            <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button"
                               aria-haspopup="false" aria-expanded="false">
                                <img src="{{ asset('assets/images/users/avatar-1.jpg') }}" alt="user" class="rounded-circle">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right profile-dropdown " aria-labelledby="Preview">
                                <!-- item-->
                                <div class="dropdown-item noti-title">
                                    <h5 class="text-overflow"><small> {{ Auth::user()->name ?? 'N/A' }}</small> </h5>
                                </div>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <i class="zmdi zmdi-account-circle"></i> <span>Profile</span>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <i class="zmdi zmdi-settings"></i> <span>Settings</span>
                                </a>

                                <!-- item-->
                                <a href="{{ route('logout') }}" class="dropdown-item notify-item" onclick="event.preventDefault();
                                document.getElementById('login-form').submit();">

                                    <i class="zmdi zmdi-power"></i> <span>{{ __('Logout') }}</span>
                                </a>
                                <form action="{{ route('logout') }}" id="login-form" method="POST" style="display:none">
                                    @csrf
                                </form>
                            </div>
                        </li>

                    </ul>

                    <ul class="list-inline menu-left mb-0">
                        <li class="float-left">
                            <button class="button-menu-mobile open-left waves-light waves-effect">
                                <i class="dripicons-menu"></i>
                            </button>
                        </li>
                        <li class="hide-phone app-search">
                            <form role="search" class="">
                                <input type="text" placeholder="Search..." class="form-control">
                                <a href=""><i class="fa fa-search"></i></a>
                            </form>
                        </li>
                    </ul>

                </nav>

            </div>
            <!-- Top Bar End -->


            <!-- ========== Left Sidebar Start ========== -->
            <div class="left side-menu">
                <div class="slimscroll-menu" id="remove-scroll">

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <!-- Left Menu Start -->
                        <ul class="metismenu" id="side-menu">
                            {{-- <li class="menu-title">Navigation</li> --}}

                            <li>
                                <a href="{{ url('dashboard') }}">
                                    <i class="fi-air-play"></i><span class="badge badge-success pull-right"></span> <span> Dashboard </span>
                                </a>
                            </li>
                            {{-- Category --}}
                            <li>
                                <a href="javascript: void(0);" class="sl-menu-link @yield('category_active')"><i class="fi-layers"></i> <span> Category </span> <span class="menu-arrow"></span></a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li><a href="{{ url('admin/category-list') }}">Category-list</a></li>
                                    <li><a href="{{ url('admin/category-add') }}">Category-Add</a></li>
                                    <li><a href="{{ url('admin/category-trashlist') }}">Trash</a></li>
                                </ul>
                            </li>
                            {{-- Sub Category --}}
                            <li>
                                <a href="javascript: void(0);" class="sl-menu-link @yield('subCategory_active')"><i class="mdi mdi-lan"></i> <span>Sub-Category </span> <span class="menu-arrow"></span></a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li><a href="{{ route('SubCategoryAdd') }}">Sub-Category-Add</a></li>
                                    <li><a href="{{ route('SubCategoryView') }}">Sub-Category-list</a></li>
                                    <li><a href="{{ route('SubcategoryTrashlist') }}">Trash</a></li>
                                </ul>
                            </li>
                            {{-- Brand --}}
                            <li>
                                <a href="javascript: void(0);" class="sl-menu-link @yield('brand_active')"><i class="mdi mdi-heart-outline"></i> <span>Brand</span> <span class="menu-arrow"></span></a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li><a href="{{ route('brandAdd') }}">Brand-Add</a></li>
                                    <li><a href="{{ route('brandView') }}">Brand-List</a></li>
                                    <li><a href="{{ route('brandTrash') }}">Trash</a></li>
                                </ul>
                            </li>
                            {{-- Product --}}
                            <li>
                                <a href="javascript: void(0);" class="sl-menu-link @yield('product_active')"><i class="mdi mdi-package-variant-closed"></i> <span>Product </span> <span class="menu-arrow"></span></a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li><a href="{{ route('ProductAdd') }}">Product Add</a></li>
                                    <li><a href="{{ route('ProductView') }}">Product List</a></li>
                                    <li><a href="{{ route('ProductTrashlist') }}">Trash</a></li>
                                </ul>
                            </li>
                            {{-- Blog --}}
                            <li>
                                <a href="javascript: void(0);" class="sl-menu-link @yield('blog_active')"><i class="mdi mdi-package-variant-closed"></i> <span>Blog</span> <span class="menu-arrow"></span></a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li><a href="{{ route('blog.index') }}">Blog Index</a></li>
                                    <li><a href="{{ route('blog.create') }}">Blog Add</a></li>
                                    {{-- <li><a href="{{ route('ProductTrashlist') }}">Blog Trash</a></li> --}}
                                </ul>
                            </li>
                            {{-- Coupons --}}
                            <li>
                                <a href="{{ route('coupon') }}" class="sl-menu-link @yield('coupon_active')"><i class="mdi mdi-coin"></i><span> Coupons </span></a>
                            </li>
                            {{-- Order --}}
                            <li>
                                <a href="{{ route('Orders') }}" class="sl-menu-link @yield('order_active')"><i class="mdi mdi-coin"></i><span> Order </span></a>
                            </li>

                            <li>
                                <a href="javascript: void(0);"><i class="fi-target"></i> <span> Admin UI </span> <span class="menu-arrow"></span></a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li><a href="admin-grid.html">Grid</a></li>
                                    <li><a href="admin-sweet-alert.html">Sweet Alert</a></li>
                                    <li><a href="admin-tiles.html">Tiles Box</a></li>
                                    <li><a href="admin-nestable.html">Nestable List</a></li>
                                    <li><a href="admin-rangeslider.html">Range Slider</a></li>
                                    <li><a href="admin-ratings.html">Ratings</a></li>
                                    <li><a href="admin-filemanager.html">File Manager</a></li>
                                    <li><a href="admin-lightbox.html">Lightbox</a></li>
                                    <li><a href="admin-scrollbar.html">Scroll bar</a></li>
                                    <li><a href="admin-slider.html">Slider</a></li>
                                    <li><a href="admin-treeview.html">Treeview</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="javascript: void(0);"><i class="fi-briefcase"></i> <span> UI Kit </span> <span class="menu-arrow"></span></a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li><a href="ui-typography.html">Typography</a></li>
                                    <li><a href="ui-panels.html">Panels</a></li>
                                    <li><a href="ui-buttons.html">Buttons</a></li>
                                    <li><a href="ui-modals.html">Modals</a></li>
                                    <li><a href="ui-checkbox-radio.html">Checkboxs-Radios</a></li>
                                    <li><a href="ui-spinners.html">Spinners</a></li>
                                    <li><a href="ui-ribbons.html">Ribbons</a></li>
                                    <li><a href="ui-portlets.html">Portlets</a></li>
                                    <li><a href="ui-tabs.html">Tabs</a></li>
                                    <li><a href="ui-progressbars.html">Progress Bars</a></li>
                                    <li><a href="ui-notifications.html">Notification</a></li>
                                    <li><a href="ui-carousel.html">Carousel</a>
                                    <li><a href="ui-video.html">Video</a>
                                    <li><a href="ui-tooltips-popovers.html">Tooltips & Popovers</a></li>
                                    <li><a href="ui-images.html">Images</a></li>
                                    <li><a href="ui-bootstrap.html">Bootstrap UI</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="tickets.html"><i class="fi-help"></i><span class="badge badge-danger pull-right">New</span> <span> Tickets </span></a>
                            </li>

                            <li>
                                <a href="javascript: void(0);"><i class="fi-box"></i><span> Icons </span> <span class="menu-arrow"></span></a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li><a href="icons-colored.html">Colored Icons</a></li>
                                    <li><a href="icons-materialdesign.html">Material Design</a></li>
                                    <li><a href="icons-dripicons.html">Dripicons</a></li>
                                    <li><a href="icons-fontawesome.html">Font awesome</a></li>
                                    <li><a href="icons-feather.html">Feather Icons</a></li>
                                    <li><a href="icons-simple-line.html">Simple line Icons</a></li>
                                    <li><a href="icons-flags.html">Flag Icons</a></li>
                                    <li><a href="icons-file.html">File Icons</a></li>
                                    <li><a href="icons-pe7.html">PE7 Icons</a></li>
                                    <li><a href="icons-typicons.html">Typicons</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="javascript: void(0);"><i class="fi-mail"></i><span> Email </span> <span class="menu-arrow"></span></a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li><a href="email-inbox.html">Inbox</a></li>
                                    <li><a href="email-read.html">Read Email</a></li>
                                    <li><a href="email-compose.html">Compose Email</a></li>
                                </ul>
                            </li>

                            <li class="menu-title">More</li>

                            <li>
                                <a href="javascript: void(0);"><i class="fi-map"></i> <span> Maps </span> <span class="menu-arrow"></span></a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li><a href="maps-google.html">Google Maps</a></li>
                                    <li><a href="maps-google-full.html">Full Google Map</a></li>
                                    <li><a href="maps-vector.html">Vector Maps</a></li>
                                    <li><a href="maps-mapael.html">Mapael Maps</a></li>
                                </ul>
                            </li>

                            <li><a href="calendar.html"><i class="fi-clock"></i> <span>Calendar</span> </a></li>

                            <li>
                                <a href="javascript: void(0);"><i class="fi-paper-stack"></i><span> Pages </span> <span class="menu-arrow"></span></a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li><a href="page-starter.html">Starter Page</a></li>
                                    <li><a href="page-login.html">Login</a></li>
                                    <li><a href="page-register.html">Register</a></li>
                                    <li><a href="page-logout.html">Logout</a></li>
                                    <li><a href="page-recoverpw.html">Recover Password</a></li>
                                    <li><a href="page-lock-screen.html">Lock Screen</a></li>
                                    <li><a href="page-confirm-mail.html">Confirm Mail</a></li>
                                    <li><a href="page-404.html">Error 404</a></li>
                                    <li><a href="page-404-alt.html">Error 404-alt</a></li>
                                    <li><a href="page-500.html">Error 500</a></li>
                                </ul>
                            </li>
                        </ul>

                    </div>
                    <!-- Sidebar -->
                    <div class="clearfix"></div>

                </div>
                <!-- Sidebar -left -->

            </div>
            <!-- Left Sidebar End -->



            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->

            @yield('content')


            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->


        </div>
        <!-- END wrapper -->



        <!-- jQuery  -->
        <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/js/tether.min.js') }}"></script><!-- Tether for Bootstrap -->
        <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('assets/js/metisMenu.min.js') }}"></script>
        <script src="{{ asset('assets/js/waves.js') }}"></script>
        <script src="{{ asset('assets/js/jquery.slimscroll.js') }}"></script>

        <!-- Dashboard init -->
        <script src="{{ asset('assets/pages/jquery.dashboard.js ') }}"></script>

        <!-- App js -->
        <script src="{{ asset('assets/js/jquery.core.js ') }}"></script>
        <script src="{{ asset('assets/js/jquery.app.js ') }}"></script>
        <script>
            $("#checkAll").click(function(){
                $('input:checkbox').not(this).prop('checked', this.checked);
            });
        </script>
        @yield('footer_js')

    </body>
</html>
