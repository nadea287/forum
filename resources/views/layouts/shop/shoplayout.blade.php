@include('layouts.partials.appheader')
<main>
    <div class="global-container">
        <div class="container-fluid" style="min-height: 100vh">
            @yield('content')
        </div>
    </div>
</main>
@include('layouts.blogfooter')
