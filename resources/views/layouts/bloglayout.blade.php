@include('layouts.partials.appheader')
{{--@include('layouts.blogheader')--}}
    <main>
        <div class="global-container">
            <div class="container-fluid" style="min-height: 100vh">
                <div class="row">
                    <div class="col-9">
                        <div class="main-left-container">
                            @yield('content')
                        </div>
                    </div>
                    @include('layouts.partials.leftbanner')
                </div>
            </div>
        </div>
    </main>
@include('layouts.blogfooter')
