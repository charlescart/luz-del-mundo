<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon-->
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}">

    <title>{{ config('app.name', 'Laravel') }} - {{ __('Dashboard') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    @include('mensajes')
    @stack('scripts')

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @stack('styles')

    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="{{ asset('css/plugins/font-awesome/font-awesome.min.css') }}">
</head>
<body>
<div class="page">
    <!-- Main Navbar-->
    <header class="header">
        <nav class="navbar p-1 border-bottom-blue bd-navbar">
            <!-- Search Box -->
            <div class="search-box">
                <button class="dismiss"><i class="icon-close"></i></button>
                <form id="searchForm" action="#" role="search">
                    <input type="search" placeholder="What are you looking for..." class="form-control">
                </form>
            </div>
            <div class="container-fluid">
                <div class="navbar-holder d-flex align-items-center justify-content-between">
                    <!-- Navbar Header-->
                    <div class="navbar-header">
                        <!-- Navbar Brand -->
                        <a href="{{ route('home') }}" class="navbar-brand d-none d-sm-inline-block p-0">
                            <div class="brand-text d-none d-lg-inline-block">
                                <img src="{{ asset('img/logo_2.png') }}" alt="" class="img-fluid">
                                <span class="text-luzdelmundo">{{ config('app.name', 'Laravel') }}</span>
                            </div>
                            <div class="brand-text d-none d-sm-inline-block d-lg-none"><strong>BD</strong></div>
                        </a>
                        <!-- Toggle Button-->
                        <a id="toggle-btn" href="#" class="menu-btn active"><span></span><span></span><span></span></a>
                    </div>
                    <!-- Navbar Menu -->
                    <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
                        <!-- Search-->
                        <li class="nav-item d-flex align-items-center">
                            <a id="search" href="#"> <i class="icon-search"></i> </a>
                        </li>

                        <!-- Notifications-->
                        <li class="nav-item dropdown">
                            <a id="notifications" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link">
                                <i class="fa fa-bell-o"></i>
                                <span class="badge bg-red badge-corner">12</span>
                            </a>
                            <ul aria-labelledby="notifications" class="dropdown-menu">
                                <li><a rel="nofollow" href="#" class="dropdown-item">
                                        <div class="notification">
                                            <div class="notification-content"><i class="fa fa-envelope bg-green"></i>You
                                                have 6 new messages
                                            </div>
                                            <div class="notification-time">
                                                <small>4 minutes ago</small>
                                            </div>
                                        </div>
                                    </a></li>
                                <li><a rel="nofollow" href="#" class="dropdown-item">
                                        <div class="notification">
                                            <div class="notification-content"><i class="fa fa-twitter bg-blue"></i>You
                                                have 2 followers
                                            </div>
                                            <div class="notification-time">
                                                <small>4 minutes ago</small>
                                            </div>
                                        </div>
                                    </a></li>
                                <li><a rel="nofollow" href="#" class="dropdown-item">
                                        <div class="notification">
                                            <div class="notification-content"><i class="fa fa-upload bg-orange"></i>Server
                                                Rebooted
                                            </div>
                                            <div class="notification-time">
                                                <small>4 minutes ago</small>
                                            </div>
                                        </div>
                                    </a></li>
                                <li><a rel="nofollow" href="#" class="dropdown-item">
                                        <div class="notification">
                                            <div class="notification-content"><i class="fa fa-twitter bg-blue"></i>You
                                                have 2 followers
                                            </div>
                                            <div class="notification-time">
                                                <small>10 minutes ago</small>
                                            </div>
                                        </div>
                                    </a></li>
                                <li><a rel="nofollow" href="#" class="dropdown-item all-notifications text-center">
                                        <strong>view all notifications </strong></a></li>
                            </ul>
                        </li>

                        <!-- Messages -->
                        <li class="nav-item dropdown">
                            <a id="messages" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link">
                                <i class="fa fa-envelope-o"></i>
                                <span class="badge bg-orange badge-corner">10</span>
                            </a>
                            <ul aria-labelledby="notifications" class="dropdown-menu">
                                <li>
                                    <a rel="nofollow" href="#" class="dropdown-item d-flex">
                                        <div class="msg-profile">
                                            <img src="{{ Avatar::create(Auth::user()->name)->toBase64() }}" alt="..." class="img-fluid rounded-circle">
                                        </div>
                                        <div class="msg-body">
                                            <h3 class="h5">Jason Doe</h3><span>Sent You Message</span>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a rel="nofollow" href="#" class="dropdown-item d-flex">
                                        <div class="msg-profile">
                                            <img src="{{ Avatar::create(Auth::user()->name)->toBase64() }}" alt="..." class="img-fluid rounded-circle">
                                        </div>
                                        <div class="msg-body">
                                            <h3 class="h5">Frank Williams</h3><span>Sent You Message</span>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a rel="nofollow" href="#" class="dropdown-item d-flex">
                                        <div class="msg-profile">
                                            <img src="{{ Avatar::create(Auth::user()->name)->toBase64() }}" alt="..." class="img-fluid rounded-circle">
                                        </div>
                                        <div class="msg-body">
                                            <h3 class="h5">Ashley Wood</h3><span>Sent You Message</span>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a rel="nofollow" href="#" class="dropdown-item all-notifications text-center">
                                        <strong>Read all messages </strong>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- Languages dropdown -->
                        <li class="nav-item dropdown">
                            <a id="languages" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link language dropdown-toggle">
                                @switch(App::getLocale())
                                    @case('en')
                                        <img src="{{ asset('img/united-states.png') }}" width="20" height="auto" alt="{{ __('English') }}">
                                        <span class="d-none d-sm-inline-block">{{ __('English') }}</span>
                                        @break

                                    @case('es')
                                        <img src="{{ asset('img/spain.png') }}" width="20" height="auto" alt="{{ __('Spanish') }}">
                                        <span class="d-none d-sm-inline-block">{{ __('Spanish') }}</span>
                                        @break

                                    @default
                                        <img src="{{ asset('img/united-states.png') }}" width="20" height="auto" alt="{{ __('English') }}">
                                        <span class="d-none d-sm-inline-block">{{ __('English') }}</span>
                                @endswitch
                            </a>
                            <ul aria-labelledby="languages" class="dropdown-menu">
                                <li>
                                    <a rel="nofollow" href="{{ url('lang', 'es') }}" class="dropdown-item">
                                        <img src="{{ asset('img/spain.png') }}" width="20" height="auto" alt="English" class="mr-2"> {{ __('Spanish') }}
                                    </a>
                                </li>
                                <li>
                                    <a rel="nofollow" href="{{ url('lang', 'en') }}" class="dropdown-item">
                                        <img src="{{ asset('img/united-states.png') }}" width="20" height="auto" alt="English" class="mr-2"> {{ __('English') }}
                                    </a>
                                </li>
                                {{--  <li>
                                    <a rel="nofollow" href="#" class="dropdown-item">
                                        <img src="img/flags/16/FR.png" alt="English" class="mr-2">French
                                    </a>
                                </li>  --}}
                            </ul>
                        </li>

                        <!-- Logout    -->
                        <li class="nav-item">
                            <a class="nav-link logout" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <span class="d-none d-sm-inline"> {{ __('Logout') }} </span>
                                <i class="fa fa-sign-out"></i>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <div class="page-content d-flex align-items-stretch">
        <!-- Side Navbar -->
        <nav class="side-navbar text-dark">
            <!-- Sidebar Header-->
            <div class="sidebar-header d-flex align-items-center justify-content-center">
                <div class="avatar"><img src="{{ Avatar::create(Auth::user()->name)->toBase64() }}" alt="{{ Auth::user()->name }}" class="img-fluid rounded-circle"></div>
                <div class="title">
                    <h1 class="h4">{{Auth::user()->name}}</h1>
                    <p>Web Designer</p>
                </div>
            </div>
            <!-- Sidebar Navidation Menus-->
            <span class="heading text-dark">Main</span>
            <ul class="list-unstyled text-dark">

                <li class="{{ ($module == 'Home') ? 'active' : '' }}">
                    <a href="{{route('home')}}">
                        <i class="icon-home"></i> {{ __('Home') }}
                    </a>
                </li>

                @hasrole('Administrator')
                    <li>
                        <a href="#configuracionDropdown" aria-expanded="{{ ($dropDown == 'Configuration') ? 'true' : 'false' }}" data-toggle="collapse">
                            <i class="fa fa-cogs" aria-hidden="true"></i> {{ __('Configuration') }}
                        </a>
                        <ul id="configuracionDropdown" class="collapse list-unstyled {{ ($dropDown == 'Configuration') ? 'show' : '' }} ">
                            <li class="{{ ($module == 'Roles') ? 'active' : '' }}"><a href="{{ route('roles.index') }}">{{ __('Roles') }}</a></li>
                            <li class="{{ ($module == 'assingRoles') ? 'active' : '' }}"><a href="{{ route('assing-roles.index') }}">{{ __('Assing Roles') }}</a></li>
                            <li class="{{ ($module == 'guestUser') ? 'active' : '' }}"><a href="{{ route('guest-user.index') }}">{{ __('Invite User') }}</a></li>
                        </ul>
                    </li>
                @endhasrole

                <li>
                    <a href="#mysFinancesDropdown" aria-expanded="{{ ($dropDown == 'Finances') ? 'true' : 'false' }}" data-toggle="collapse">
                        <i class="fa fa-bar-chart" aria-hidden="true"></i>
                        {{ __('Finances') }}
                    </a>
                    <ul id="mysFinancesDropdown" class="collapse list-unstyled {{ ($dropDown == 'Finances') ? 'show' : '' }} ">
                        <li class="{{ ($module == 'Finances') ? 'active' : '' }}"><a href="{{ route('finances.index') }}">{{ __('Mys Finances') }}</a></li>
                        <li class="{{ ($module == 'Tithe') ? 'active' : '' }}"><a href="{{ route('finances.index') }}">{{ __('Mys Tithes') }}</a></li>
                    </ul>
                </li>

                @hasanyrole('Pastor Jefe de Mision|Administrator')
                    <li>
                        <a href="#churchDropdown" aria-expanded="{{ ($dropDown == 'Church') ? 'true' : 'false' }}" data-toggle="collapse">
                            <i class="fa fa-cogs" aria-hidden="true"></i> {{ __('My Church') }}
                        </a>
                        <ul id="churchDropdown" class="collapse list-unstyled {{ ($dropDown == 'Church') ? 'show' : '' }} ">
                            <li class="{{ ($module == 'Config. Church') ? 'active' : '' }}"><a href="{{ route('churches.index') }}">{{ __('Config. My Church') }}</a></li>
                            <li class="{{ ($module == 'Config. Work Team') ? 'active' : '' }}"><a href="{{ route('roles.index') }}">{{ __('Config. Work Team') }}</a></li>
                            <li class="{{ ($module == 'Pastoral Tithes') ? 'active' : '' }}"><a href="{{ route('roles.index') }}">{{ __('Pastoral Tithes') }}</a></li>
                            <li class="{{ ($module == 'Reports of Tithes') ? 'active' : '' }}"><a href="{{ route('roles.index') }}">{{ __('Reports of Tithes') }}</a></li>
                        </ul>
                    </li>
                @endhasanyrole

                {{--<li class="{{ ($module == 'Finances') ? 'active' : '' }}">
                    <a href="{{ route('finances.index') }}">
                        <i class="fa fa-bar-chart"></i> {{ __('Finances') }}
                    </a>
                </li>--}}

                {{--  iconos individuales  --}}
                {{--  <li><a href="charts.html"> <i class="fa fa-bar-chart"></i>Charts </a></li>  --}}
                {{--  <li><a href="forms.html"> <i class="icon-padnote"></i>Forms </a></li>  --}}
                {{--  <li><a href="login.html"> <i class="icon-interface-windows"></i>Login page </a></li>  --}}
            </ul>
            {{--  <span class="heading">Extras</span>
            <ul class="list-unstyled">
                <li><a href="#"> <i class="icon-flask"></i>Demo </a></li>
                <li><a href="#"> <i class="icon-screen"></i>Demo </a></li>
                <li><a href="#"> <i class="icon-mail"></i>Demo </a></li>
                <li><a href="#"> <i class="icon-picture"></i>Demo </a></li>
            </ul>  --}}
        </nav>
        <div class="content-inner bg-white">
            @yield('content')
            <!-- Page Footer-->
            <footer class="main-footer p-0 p-sm-2">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <p>{{ __('ProSoftware C.A') }} &copy; 2018-2020</p>
                        </div>
                        <div class="col-sm-6 text-right">
                            <p>{{ __('Developed by') }} <a href="#!" class="external">{{ __('ProSoftware C.A') }}</a></p>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
</div>
</body>
</html>
