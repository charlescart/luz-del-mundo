<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Favicon-->
    <link rel="shortcut icon" href="{{ secure_asset('favicon.png') }}">

    <!-- Scripts -->
    <script src="{{ secure_asset('js/app.js') }}" defer></script>
    @include('mensajes')
    @stack('scripts')

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ secure_asset('css/app.css') }}" rel="stylesheet">
    @stack('styles')
</head>
<body>
    <div id="app">
        <div id="particles-js"></div>
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel border-bottom-blue bd-navbar p-0">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ secure_asset('img/logo_2.png') }}" alt="" class="img-fluid">
                    <span class="text-luzdelmundo">{{ config('app.name', 'Laravel') }}</span>
                </a>
                <button class="navbar-toggler mr-2 mr-sm-0" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        <li class="nav-item dropdown text-center text-sm-left">
                            <a id="navbarDropdownLanguage" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                @switch(App::getLocale())
                                    @case('en')
                                        {{ __('English') }}
                                        @break

                                    @case('es')
                                        {{ __('Spanish') }}
                                        @break

                                    @default
                                        {{ __('English') }}
                                @endswitch
                                <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownLanguage">
                                <a class="dropdown-item" href="{{ url('lang', 'es') }}">
                                    {{ __('Spanish') }}
                                </a>
                                <a class="dropdown-item" href="{{ url('lang', 'en') }}">
                                    {{ __('English') }}
                                </a>
                            </div>
                        </li>
                        @guest
                            <li class="nav-item text-center text-sm-left">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            <li class="nav-item text-center text-sm-left">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @else
                            <li class="nav-item dropdown text-center text-sm-left">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('home') }}">{{ __('Dashboard') }}</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4" style="min-height: 563px;">
            @yield('content')
        </main>

    </div>
    <footer class="bg-white border-top text-secondary" style="min-height: 645px;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col">
                    <div class="text-center" style="margin-top: 150px;">
                        Footer
                    </div>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
