<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Forum</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@200;300;400;600&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('css/stripe.css') }}">
</head>
<nav class="stripe-nav">
    <div class="stripe-nav-center">
        <div class="stripe-nav-header">
            <img src="{{ asset('/images/dicussion.png') }}" class="stripe-nav-logo" alt="logo">
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
        <button class="stripe-btn stripe-signin-btn">sign in</button>
    </div>
</nav>

<section class="stripe-hero">
    <div class="stripe-hero-center">
        <article class="stripe-hero-info">
            <h1>payments infrastructure <br /> for the internet</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Atque consequuntur debitis ducimus eius enim exercitationem molestiae optio recusandae, voluptates. Dolore!</p>
            <button class="stripe-btn">start now</button>
        </article>
        <article class="stripe-hero-images">
            <img src="" alt="image-here" class="stripe-phone-img">
        </article>
    </div>
</section>

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



<script type="module" src="{{ asset('/js/stripe-menu.js') }}"></script>
</body>
</html>
