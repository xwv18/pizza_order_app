    <!DOCTYPE html>
    <html lang="en">

    <head>
        <!-- Required meta tags-->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="au theme template">
        <meta name="author" content="Hau Nguyen">
        <meta name="keywords" content="au theme template">

        <!-- Title Page-->
        <title>@yield('title')</title>

        <!-- Fontfaces CSS-->
        <link href="{{ asset('admin/css/font-face.css') }}" rel="stylesheet" media="all">
        <link href="{{ asset('admin/vendor/font-awesome-4.7/css/font-awesome.min.css') }}" rel="stylesheet"
            media="all">
        <link href="{{ asset('admin/vendor/font-awesome-5/css/fontawesome-all.min.css') }}" rel="stylesheet"
            media="all">
        <link href="{{ asset('admin/vendor/mdi-font/css/material-design-iconic-font.min.css') }}" rel="stylesheet"
            media="all">

        <!-- Bootstrap CSS-->
        <link href="{{ asset('admin/vendor/bootstrap-4.1/bootstrap.min.css') }}" rel="stylesheet" media="all">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

        {{-- font awasome  --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
            integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />

        <!-- Vendor CSS-->
        <link href="{{ asset('admin/vendor/animsition/animsition.min.css') }}" rel="stylesheet" media="all">
        <link href="{{ asset('admin/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css') }}"
            rel="stylesheet" media="all">
        <link href="{{ asset('admin/vendor/wow/animate.css') }}" rel="stylesheet" media="all">
        <link href="{{ asset('admin/vendor/css-hamburgers/hamburgers.min.css') }}" rel="stylesheet" media="all">
        <link href="{{ asset('admin/vendor/slick/slick.css') }}" rel="stylesheet" media="all">
        <link href="{{ asset('admin/vendor/select2/select2.min.css') }}" rel="stylesheet" media="all">
        <link href="{{ asset('admin/vendor/perfect-scrollbar/perfect-scrollbar.css') }}" rel="stylesheet"
            media="all">

        <!-- Main CSS-->
        <link href="{{ asset('admin/css/theme.css') }}" rel="stylesheet" media="all">

    </head>

    <body class="animsition">
        <div class="page-wrapper">
            <!-- MENU SIDEBAR-->
            <aside class="menu-sidebar d-none d-lg-block">
                <div class="logo">
                    <a href="#">
                        <img src="{{ asset('admin/images/icon/logo.png') }}" alt="Cool Admin" />
                    </a>
                </div>
                <div class="menu-sidebar__content js-scrollbar1">
                    <nav class="navbar-sidebar">
                        <ul class="list-unstyled navbar__list">
                            <li class="active has-sub">
                                <a class="js-arrow" href="{{ route('category#home') }} ">
                                    <i class="fas fa-tachometer-alt"></i>Home Page
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('products#list') }}">
                                    <i class="fa-solid fa-pizza-slice"></i>Products</a>
                            </li>
                            <li>
                                <a href="{{ route('admin#orderList') }}">
                                    <i class="fa-solid fa-list-ul"></i>Order List</a>
                            </li>
                            <li>
                                <a href="{{ route('user#list') }}">
                                    <i class="fa-solid fa-users"></i>Customers List</a>
                            </li>
                            <li>
                                <a href="{{ route('user#contactList') }}">
                                    <i class="fa-solid fa-user-tag"></i>User Contact List</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </aside>
            <!-- END MENU SIDEBAR-->

            <!-- PAGE CONTAINER-->
            <div class="page-container">
                <!-- HEADER DESKTOP-->
                <header class="header-desktop">
                    <div class="section__content section__content--p30">
                        <div class="container-fluid">
                            <div class="header-wrap">
                                <form class="form-header" action="" method="POST">
                                    {{-- <input class="au-input au-input--xl" type="text" name="search"
                                        placeholder="Search for datas &amp; reports..." />
                                    <button class="au-btn--submit" type="submit">
                                        <i class="zmdi zmdi-search"></i>
                                    </button> --}}
                                </form>
                                <div class="header-button">
                                    <div class="noti-wrap">
                                        <div class="noti__item js-item-menu">
                                            <i class="zmdi zmdi-notifications"></i>
                                            <span class="quantity">3</span>
                                            <div class="notifi-dropdown js-dropdown">
                                                <div class="notifi__title">
                                                    <p>You have 3 Notifications</p>
                                                </div>
                                                <div class="notifi__item">
                                                    <div class="bg-c1 img-cir img-40">
                                                        <i class="zmdi zmdi-email-open"></i>
                                                    </div>
                                                    <div class="content">
                                                        <p>You got a email notification</p>
                                                        <span class="date">April 12, 2018 06:50</span>
                                                    </div>
                                                </div>
                                                <div class="notifi__item">
                                                    <div class="bg-c2 img-cir img-40">
                                                        <i class="zmdi zmdi-account-box"></i>
                                                    </div>
                                                    <div class="content">
                                                        <p>Your account has been blocked</p>
                                                        <span class="date">April 12, 2018 06:50</span>
                                                    </div>
                                                </div>
                                                <div class="notifi__item">
                                                    <div class="bg-c3 img-cir img-40">
                                                        <i class="zmdi zmdi-file-text"></i>
                                                    </div>
                                                    <div class="content">
                                                        <p>You got a new file</p>
                                                        <span class="date">April 12, 2018 06:50</span>
                                                    </div>
                                                </div>
                                                <div class="notifi__footer">
                                                    <a href="#">All notifications</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="account-wrap">
                                        <div class="account-item clearfix js-item-menu">
                                            <div class="image">
                                                @if (Auth::user()->image == null)
                                                    @if (Auth::user()->gender == 'male')
                                                        <img class="img-thumbnail shadow-sm  col-8"
                                                            src="{{ asset('image/default_male_user_image.png') }}"
                                                            alt="">
                                                    @else
                                                        <img class="img-thumbnail shadow-sm  col-8"
                                                            src="{{ asset('image/default_female_user_image.png') }}"
                                                            alt="">
                                                    @endif
                                                @else
                                                    <img src="{{ asset('storage/' . Auth::user()->image) }}"
                                                        alt="John Doe" />
                                                @endif
                                            </div>
                                            <div class="content">
                                                <a class="js-acc-btn" href="#">{{ Auth::user()->name }}</a>
                                            </div>
                                            <div class="account-dropdown js-dropdown">
                                                <div class="info clearfix">
                                                    <div class="image">
                                                        <a href="#">
                                                            @if (Auth::user()->image == null)
                                                                @if (Auth::user()->gender == 'male')
                                                                    <img class="img-thumbnail shadow-sm  col-8"
                                                                        src="{{ asset('image/default_male_user_image.png') }}"
                                                                        alt="">
                                                                @else
                                                                    <img class="img-thumbnail shadow-sm  col-8"
                                                                        src="{{ asset('image/default_female_user_image.png') }}"
                                                                        alt="">
                                                                @endif
                                                            @else
                                                                <img src="{{ asset('storage/' . Auth::user()->image) }}"
                                                                    alt="John Doe" />
                                                            @endif
                                                        </a>
                                                    </div>
                                                    <div class="content">
                                                        <h5 class="name">
                                                            <a href="#">{{ Auth::user()->name }}</a>
                                                        </h5>
                                                        <span class="email">{{ Auth::user()->email }}</span>
                                                    </div>
                                                </div>
                                                <div class="account-dropdown__body">
                                                    <div class="account-dropdown__item">
                                                        <a href="{{ route('adminAccount#info') }}">
                                                            <i class="fa-regular fa-user"></i>Account</a>
                                                    </div>
                                                </div>
                                                <div class="account-dropdown__body">
                                                    <div class="account-dropdown__item">
                                                        <a href="{{ route('admin#list') }}">
                                                            <i class="fa-solid fa-users"></i>Adimin Lists</a>
                                                    </div>
                                                </div>
                                                <div class="account-dropdown__body">
                                                    <div class="account-dropdown__item">
                                                        <a href="{{ route('admin#changePasswordPage') }}">
                                                            <i class="fa-solid fa-key"></i>Change Password</a>
                                                    </div>
                                                </div>
                                                <div class="account-dropdown__footer">
                                                    <form action="{{ route('logout') }}" method="post"
                                                        class=" p-4">
                                                        @csrf
                                                        <i class="zmdi zmdi-power mr-4 text-black"></i>
                                                        <button type="submit">Logout</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </header>
                <!-- HEADER DESKTOP-->

                @yield('content')
            </div>

        </div>


        <!-- Jquery JS-->
        <script src="{{ asset('admin/vendor/jquery-3.2.1.min.js') }}"></script>
        <!-- Bootstrap JS-->
        <script src="{{ asset('admin/vendor/bootstrap-4.1/popper.min.js') }}"></script>
        <script src="{{ asset('admin/vendor/bootstrap-4.1/bootstrap.min.js') }}"></script>
        <!-- Vendor JS       -->
        <script src="{{ asset('admin/vendor/slick/slick.min.js') }}"></script>
        <script src="{{ asset('admin/vendor/wow/wow.min.js') }}"></script>
        <script src="{{ asset('admin/vendor/animsition/animsition.min.js') }}"></script>
        <script src="{{ asset('admin/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js') }}"></script>
        <script src="{{ asset('admin/vendor/counter-up/jquery.waypoints.min.js') }}"></script>
        <script src="{{ asset('admin/vendor/counter-up/jquery.counterup.min.js') }}"></script>
        <script src="{{ asset('admin/vendor/circle-progress/circle-progress.min.js') }}"></script>
        <script src="{{ asset('admin/vendor/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
        <script src="{{ asset('admin/vendor/chartjs/Chart.bundle.min.js') }}"></script>
        <script src="{{ asset('admin/vendor/select2/select2.min.js') }}"></script>

        {{-- boostarp JS --}}
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
        </script>

        <!-- Main JS-->
        <script src="{{ asset('admin/js/main.js') }}"></script>

    </body>
    @yield('scriptSection')

    </html>
    <!-- end document-->
