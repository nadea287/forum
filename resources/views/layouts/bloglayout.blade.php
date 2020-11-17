@include('layouts.partials.appheader')
{{--@include('layouts.blogheader')--}}
    <main>
        <div class="container-fluid" style="min-height: 100vh">
            <div class="row">
                <div class="col-9">
                    @yield('content')
                </div>
                @include('layouts.partials.leftbanner')
            </div>
        </div>
    </main>
@include('layouts.blogfooter')
