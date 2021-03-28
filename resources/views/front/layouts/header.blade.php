<!doctype html>
<html class="no-js" lang="{{ app() -> getLocale() }}" data-textdirection="{{ app() -> getLocale() === 'ar' ? 'rtl' : 'ltr'}}" class="">
{{-- js flexbox canvas canvastext webgl no-touch geolocation postmessage websqldatabase indexeddb hashchange history draganddrop websockets rgba hsla multiplebgs backgroundsize borderimage borderradius boxshadow textshadow opacity cssanimations csscolumns cssgradients cssreflections csstransforms csstransforms3d csstransitions fontface generatedcontent video audio localstorage sessionstorage webworkers no-applicationcache svg inlinesvg smil svgclippaths --}}
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title')</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('/front/')}}/assets/images/favicon.ico">

    <!-- CSS
	============================================ -->

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('/front/')}}/assets/css/bootstrap.min.css">

    <!-- Icon Font CSS -->
    <link rel="stylesheet" href="{{asset('/front/')}}/assets/css/icon-font.min.css">

    <!-- Plugins CSS -->
    <link rel="stylesheet" href="{{asset('/front/')}}/assets/css/plugins.css">

    <!-- Main Style CSS -->
    <link rel="stylesheet" href="{{asset('/front/')}}/assets/css/style.css">

    @yield('css')
    <!-- Modernizer JS -->
    <script src="{{asset('/front/')}}/assets/js/vendor/modernizr-2.8.3.min.js"></script>
    <style>
        .invalid-feedback{
            display:block;
        }

        
    </style>
</head>

<body>

<!-- Header Section Start -->
<div class="header-section section">

    <!-- Header Top Start -->
    <div class="header-top header-top-one header-top-border pt-10 pb-10">
        <div class="container">
            <div class="row align-items-center justify-content-between">

                <div class="col mt-10 mb-10">
                    <!-- Header Links Start -->
                    <div class="header-links">
                        {{-- @auth('web')
                        <a href=""><img src="{{asset('/front//')}}/assets/images/icons/car.png" alt="Car Icon"> <span>Track your order</span></a>
                        @endauth --}}
                        <div class="">

                            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)

                                <a class="" rel="alternate" hreflang="{{ $localeCode }}"
                                   href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">

                                   <img src="{{asset('/front/')}}/assets/images/icons/marker.png" alt="Car Icon">

                                    {{ $properties['native'] }}
                                </a>


                            @endforeach
                        </div>
                    </div><!-- Header Links End -->
                </div>

                <div class="col order-12 order-xs-12 order-lg-2 mt-10 mb-10">
                    <!-- Header Advance Search Start -->
                    <div class="header-advance-search">

                        <form action="#">
                            <div class="input"><input type="text" placeholder="Search your product"></div>
                            <div class="select">
                                <select class="nice-select">
                                    <option>All Categories</option>

                                    @foreach ($categories as $category)

                                    <option>{{ $category->name }}</option>

                                   @endforeach

                                </select>
                            </div>
                            <div class="submit"><button><i class="icofont icofont-search-alt-1"></i></button></div>
                        </form>

                    </div><!-- Header Advance Search End -->
                </div>

                <div class="col order-2 order-xs-2 order-lg-12 mt-10 mb-10">
                    <!-- Header Account Links Start -->



                    <div class="header-account-links" style="overflow: inherit;">
                    @guest
                        <a href="{{ route('register') }}"><i class="icofont icofont-login d-none"></i> <span>Register</span></a>
                        <a href="{{ route('login') }}"><i class="icofont icofont-login d-none"></i> <span>Login</span></a>

                    @else

        <ul class="nav navbar-nav pull-right">

        <li class="nav-item dropdown">

            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
            Hello,    {{ Auth::user()->name }} <span class="caret"></span>
            </a>



            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a href="{{ route('profile') }}" style="
                padding: 8px 0;margin-right: 0;float: inherit;
                text-align: center;font-weight: 600;
            "><span>my account</span></a>

                <hr style="margin-top: 0px;
                margin-bottom: 0px;">
                <a class="dropdown-item" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();"
            style="padding: 8px 0;
            text-align: center; font-size: 14px; font-weight: 600;"
                              >
                 {{ __('Logout') }}
             </a>

             <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                 @csrf
             </form>

            </div>
        </li>
    </ul>


                    @endguest


                     </div><!-- Header Account Links End -->
                </div>

            </div>
        </div>
    </div><!-- Header Top End -->
