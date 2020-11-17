@include('layouts.htmlheader')
<body>
    <div class="portofolio">
        <header>
            <nav>
                <h3 class="logo">Lorem ipsum</h3>
{{--                <img src="{{ asset('/images/burger.png') }}" alt="burger">--}}
                <i class="fa fa-bars" aria-hidden="true" id="menu"></i>
                <div class="nav-open">
                    <div class="contact">
                        <h3>Contact</h3>
                        <p>0245687-7458</p>
                    </div>
                    <div class="social">
                        <h3>
                            <a href="{{ route('thread.index') }}">All Threads</a>
                        </h3>
{{--                        <h3>Social</h3>--}}
{{--                        <div class="social-links">--}}
{{--                            <i class="fa fa-facebook" aria-hidden="true"></i>--}}
{{--                            <i class="fa fa-twitter" aria-hidden="true"></i>--}}
{{--                            <i class="fa fa-instagram" aria-hidden="true"></i>--}}
{{--                        </div>--}}
                    </div>
                </div>
            </nav>
            <main>
                <section class="page photographer">
                    <div class="details">
                        <h1>Elena Morell</h1>
                        <h2>photographer</h2>
                        <p>17/11/2020</p>
                    </div>
                    <div class="hero">
                        <a href="{{ url('/blog/first') }}">
                            <img src="{{ asset('/images/modelf1.jpg') }}" alt="model" class="model-left">
                            <img src="{{ asset('/images/modelf2.jpg') }}" alt="model" class="model-right">
                        </a>
                    </div>
                </section>
                <section class="page chef">
                    <div class="details">
                        <h1>Cora Flores</h1>
                        <h2>designer</h2>
                        <p>02/08/2018</p>
                    </div>
                    <div class="hero">
                        <a href="{{ url('/blog/second') }}">
                            <img src="{{ asset('/images/model6.jpg') }}" alt="model" class="model-left">
                            <img src="{{ asset('/images/model6_1.jpg') }}" alt="model" class="model-right">
                        </a>
                    </div>
                </section>
                <section class="page hairstyle">
                    <div class="details">
                        <h1>Esme Ward</h1>
                        <h2>lorem</h2>
                        <p>02/08/2018</p>
                    </div>
                    <div class="hero">
                        <a href="{{ url('/blog/third') }}">
                            <img src="{{ asset('/images/model8_1.jpg') }}" alt="model" class="model-left">
                            <img src="{{ asset('/images/model8_2.jpg') }}" alt="model" class="model-right">
                        </a>
                    </div>
                </section>
                <div class="pages">
                    <div class="page-1">
                        <h3>01</h3>
                        <i class="fa fa-circle" aria-hidden="true" id="slide active"></i>
                    </div>
                    <div class="page-2">
                        <h3>02</h3>
                        <i class="fa fa-circle" aria-hidden="true" id="slide"></i>
                    </div>
                    <div class="page-3">
                        <h3>03</h3>
{{--                        <img src="{{ asset('/images/dot.png') }}" class="slide"/>--}}
                        <i class="fa fa-circle" aria-hidden="true" id="slide"></i>
                    </div>
                </div>
            </main>
        </header>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.5.1/gsap.min.js" integrity="sha512-IQLehpLoVS4fNzl7IfH8Iowfm5+RiMGtHykgZJl9AWMgqx0AmJ6cRWcB+GaGVtIsnC4voMfm8f2vwtY+6oPjpQ==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tweene/0.5.11/tweene-all.min.js" integrity="sha512-F/pz5hyUKfNoQOI6KKFu6ppMRtGu2+9ORjaNMTYxohn0fYZJX43V2dCZWw86+u9atZcS2GyU9J1eU9pdxgGitA==" crossorigin="anonymous"></script>
    <script src="{{ asset('js/main.js') }}"></script>
</body>
</html>
