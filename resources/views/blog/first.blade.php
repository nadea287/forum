@include('layouts.htmlheader')
<body>
    <main>
        <div class="banner">
{{--            <img src="{{ asset('/images/background1.jpg') }}" alt="" class="parallax">--}}
            <div class="parallax parallax-first"></div>
            <div class="author">
                <h1>Elena Morell</h1>
                <h3>Photographer</h3>
            </div>
        </div>
        <div class="story">
            <div class="story-description">
                <h3>My Story</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aspernatur consectetur error exercitationem expedita fugiat incidunt iusto minus nemo nostrum pariatur porro, quam saepe, suscipit vel veritatis? Distinctio expedita quos unde.</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aspernatur consectetur error exercitationem expedita fugiat incidunt iusto minus nemo nostrum pariatur porro, quam saepe, suscipit vel veritatis? Distinctio expedita quos unde.</p>
            </div>
            <div class="profile">
                <img src="{{ asset('/images/profile.jpg') }}" alt="profile">
            </div>
        </div>
        <div class="my-work">
            <div class="work-description">
                <h3>My Work</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aspernatur consectetur error exercitationem expedita fugiat incidunt iusto minus nemo nostrum pariatur porro, quam saepe, suscipit vel veritatis? Distinctio expedita quos unde.</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aspernatur consectetur error exercitationem expedita fugiat incidunt iusto minus nemo nostrum pariatur porro, quam saepe, suscipit vel veritatis? Distinctio expedita quos unde.</p>
            </div>
            <div class="work-gallery">
                <img src="{{ asset('/images/gallery.jpg') }}" alt="">
                <img src="{{ asset('/images/gallery.jpg') }}" alt="">
                <img src="{{ asset('/images/gallery.jpg') }}" alt="">
                <img src="{{ asset('/images/gallery.jpg') }}" alt="">
                <img src="{{ asset('/images/gallery.jpg') }}" alt="">
                <img src="{{ asset('/images/gallery.jpg') }}" alt="">
            </div>
        </div>
    </main>

<section class="footer">
<div class="social-media-links">
            <a href=""><i class="fa fa-twitter" aria-hidden="true"></i></a>
            <a href=""><i class="fa fa-facebook-official" aria-hidden="true"></i></a>
            <a href=""><i class="fa fa-youtube-play" aria-hidden="true"></i></a>
            <a href=""><i class="fa fa-instagram" aria-hidden="true"></i></a>
</div>
</section>


</body>
</html>
