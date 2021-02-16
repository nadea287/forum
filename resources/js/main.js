function init() {
    const slides = document.querySelectorAll('.pages i');
    const pages = document.querySelectorAll('.page');
    const backgrounds = [
        `radial-gradient(#2B3760, #0B1023)`,
        `radial-gradient(#4E3022, #161616)`,
        `radial-gradient(#4E4342, #161616)`,
    ];
    //Tracker
    let current = 0;
    // let scrollSlide = 0;

    slides.forEach((slide, index) => {
        slide.addEventListener('click', function () {
            console.log(index);
            changeDots(this);
            //what slide is changing
            nextSlide(index);
        })
    });

    function changeDots(dot) {
        slides.forEach(slide => {
           slide.removeAttribute("id");
        });
        dot.setAttribute("id", "active");
    }

    function nextSlide(pageNumber) {
        const nextPage = pages[pageNumber];
        const currentPage = pages[current];
        const nextLeft = nextPage.querySelector('.hero .model-left');
        const nextRight = nextPage.querySelector('.hero .model-right');
        const currentLeft = currentPage.querySelector('.hero .model-left');
        const currentRight = currentPage.querySelector('.hero .model-right');
        const nextText = nextPage.querySelector('.details');
        const portofolio = document.querySelector('.portofolio');

        const tl = new TimelineMax({
            onStart: function () {
                slides.forEach(slide => {
                   slide.style.pointerEvents = 'none';
                })
            },
            onComplete: function () {
                slides.forEach(slide => {
                    slide.style.pointerEvents = 'all';
                })
            }
            //we cannot click on the dots untill the animation finishes
        });
        tl.fromTo(currentLeft, 0.3, {y: '-10%'}, {y: '-100%'})
            .fromTo(currentRight, 0.3, {y: '10%'}, {y: '-100%'}, '-=0.2')
            .to(portofolio, 0.3, { backgroundImage: backgrounds[pageNumber]})
        .fromTo(
            currentPage,
            0.3,
            {opacity:1, pointerEvents: 'all'},
            { opacity: 0, pointerEvents: 'none'}
            )
            .fromTo(
                nextPage,
                0.3,
                {opacity:0, pointerEvents: 'none'},
                { opacity: 1, pointerEvents: 'all'},
                    "-=0.6"
            )
            .fromTo(nextLeft, 0.3, {y: '-100%'}, {y: '-10%'}, '-=0.6')
            .fromTo(nextRight, 0.3, {y: '-100%'}, {y: '10%'}, '-=0.8')
            .fromTo(nextText, 0.3, {opacity: 0, y: 0}, { opacity: 1, y:0})
            .set(nextLeft, {clearProps: 'all'})
            .set(nextRight, {clearProps: 'all'})
        //on hover images can move

        current = pageNumber;
        //if you click on 1 -> it tracks the 1 ...
    }

    // //wheel - detects the scroll even if you don't have a scroll bar
    // document.addEventListener('wheel', throttle(scrollChange, 1500));
    // //the wheel when you scroll is only gonna work one time in 1500s
    //
    // function switchDots(dotNumber) {
    //     const activeDot = document.querySelectorAll('#slide')[dotNumber];
    //     console.log(activeDot);
    //     slides.forEach(slide => {
    //        slide.removeAttribute("id");
    //     });
    //     activeDot.setAttribute("id", "active");
    // }
    //
    // function scrollChange(e) {
    //     //! we can check where the user scrolled up or down (-100: up)
    //     if (e.deltaY > 0) {
    //         scrollSlide += 1;
    //     } else {
    //         scrollSlide -= 1;
    //     }
    //
    //     if (scrollSlide > 2) {
    //         scrollSlide = 0;
    //     }
    //
    //     if (scrollSlide < 0) {
    //         scrollSlide = 2;
    //     }
    //
    //     switchDots(scrollSlide);
    //     nextSlide(scrollSlide);
    //     console.log(scrollSlide);
    // }
    //
    // function throttle(func, limit) {
    //     let inThrottle;
    //     return function () {
    //         const args = arguments;
    //         const context = this;
    //         if (!inThrottle) {
    //             func.apply(context, args);
    //             inThrottle = true;
    //             setTimeout(() => (inThrottle = false), limit);
    //         }
    //     };
    // }


    //hamburger
    const hamburger = document.querySelector('#menu');
    const navOpen = document.querySelector('.nav-open');
    const contact = document.querySelector('.contact');
    const social = document.querySelector('.social');
    const logo = document.querySelector('.logo');

    const tl = new TimelineMax({paused: true, reversed: true});
    tl.to(navOpen, 0.5, {y:0}).fromTo(
      contact,
      0.5,
        { opacity: 0, y: 10 },
        { opacity: 1, y: 0 },
        '-=0.1',
    )
        .fromTo(
            social,
            0.5,
            { opacity: 0, y: 10 },
            { opacity: 1, y: 0 },
            '-=0.5',
        )
        .fromTo(
            logo,
            0.2,
            {color: 'white'},
            {color: 'black'},
            '-=1'
        )
        .fromTo(
            hamburger,
            0.2,
            { color: 'white' },
            { color: 'black' },
            '-=1'
        );

    hamburger.addEventListener('click', () => {
       tl.reversed() ? tl.play() : tl.reverse();
    });
}
init();




