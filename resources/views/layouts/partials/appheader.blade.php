<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Forum</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@200;300;400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap2.min.css">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/stripe.css') }}">
</head>
<nav class="stripe-nav">
    <div class="stripe-nav-center">
        <div class="stripe-nav-header">
{{--            <img src="{{ asset('/images/dicussion.png') }}" class="stripe-nav-logo" alt="logo">--}}
{{--            <span class="stripe-nav-logo" alt="logo">Logo</span>--}}
            <a href="{{ url('/') }}" class="stripe-nav-logo">Logo</a>
            <button class="stripe-btn stripe-toggle-btn">
                <i class="fa fa-bars" aria-hidden="true"></i>
            </button>
        </div>
        <ul class="stripe-nav-links">
            <li>
                <button class="stripe-link-btn">products</button>
            </li>
            <li>
                <button class="stripe-link-btn">developers</button>
            </li>
            <li>
                <button class="stripe-link-btn">company</button>
            </li>
        </ul>
        @guest
        <a href="{{ route('login') }}" class="stripe-btn stripe-signin-btn">login</a>
            @if (Route::has('register'))
                    <a class="stripe-btn stripe-signin-btn" href="{{ route('register') }}">register</a>
            @endif
        @else
        <div class="notify-count-wrapper">
            <div class="drop-btn mark-as-read">
                <i class="fa fa-bell-o" aria-hidden="true"></i>
            </div>
            <div class="notify-count notify-count-toggle">{{ count(auth()->user()->unreadNotifications) }}</div>
        </div>
            <div class="dropdown-wrapper">
                <ul class="dropdown-menu-bar">
                    <li>
                         @forelse(auth()->user()->unreadNotifications as $notification)
                             @include('layouts.partials.notification/' .
                                    snake_case(class_basename($notification->type)))
                             @empty
                             There are no notifications
                         @endforelse
                    </li>
                </ul>
            </div>

{{--            <div class="notify-count-wrapper">--}}
{{--                <div class="drop-btn">--}}
{{--                    {{ Auth::user()->name }}--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="dropdown-wrapper">--}}
{{--                <ul class="dropdown-menu-bar">--}}
{{--                    <li>--}}
{{--                        <div class="dropdown-icon">--}}
{{--                            <a href="{{ route('profile.show', ['user' => \Illuminate\Support\Facades\Auth::user()->id]) }}">My Profile</a>--}}
{{--                            <a href="{{ route('logout') }}"--}}
{{--                               onclick="event.preventDefault();--}}
{{--                                                 document.getElementById('logout-form').submit();">--}}
{{--                                logout--}}
{{--                            </a>--}}
{{--                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">--}}
{{--                                @csrf--}}
{{--                            </form>--}}
{{--                            @endguest--}}
{{--                        </div>--}}
{{--                    </li>--}}
{{--                </ul>--}}
{{--            </div>--}}

            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }}
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a href="{{ route('profile.show', ['user' => \Illuminate\Support\Facades\Auth::user()->id]) }}" class="dropdown-item">My Profile</a>
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                   logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        @endguest


    </div>
</nav>

{{--<section class="stripe-hero">--}}
{{--    <div class="stripe-hero-center">--}}
{{--        <article class="stripe-hero-info">--}}
{{--            <h1>payments infrastructure <br /> for the internet</h1>--}}
{{--            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Atque consequuntur debitis ducimus eius enim exercitationem molestiae optio recusandae, voluptates. Dolore!</p>--}}
{{--            <button class="stripe-btn">start now</button>--}}
{{--        </article>--}}
{{--        <article class="stripe-hero-images">--}}
{{--            <img src="" alt="image-here" class="stripe-phone-img">--}}
{{--        </article>--}}
{{--    </div>--}}
{{--</section>--}}

{{--sidebar--}}
<div class="sidebar-wrapper">
    <aside class="sidebar">
        <button class="close-btn">
            <i class="fa fa-times" aria-hidden="true"></i>
        </button>
        <div class="sidebar-links">
            here
        </div>
    </aside>
</div>

{{--links--}}
<aside class="submenu">
    hello
</aside>



{{--<script type="module" src="{{ asset('/js/stripe-menu.js') }}"></script>--}}
{{--</body>--}}
{{--</html>--}}
