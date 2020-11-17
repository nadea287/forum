//session messages
function sessionMessage() {
    const messageWrapper = document.querySelector('.session-wrapper');

    function sesionDisplay() {
        TweenMax.fromTo(messageWrapper, 1, {autoAlpha:0, y:100}, {autoAlpha:1, y: 0});
    }

    window.addEventListener('load', sesionDisplay);
}

sessionMessage();
