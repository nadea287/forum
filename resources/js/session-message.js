//session messages
function sessionMessage() {
    const messageWrapper = document.querySelector('.session-wrapper');

    function sesionDisplay() {
        TweenMax.fromTo(messageWrapper, 1, {autoAlpha:0, y:100}, {autoAlpha:1, y: 0});
    }

    window.addEventListener('load', sesionDisplay);
}

sessionMessage();

//LOGIN & REGISTER PAGE
const left = document.querySelector('.inner-left');
const content = document.querySelector('.content');
const protos = document.querySelectorAll('.protos');

left.addEventListener('mousemove', (event) => {
    let move = (event.clientX * 0.05) + 4;
    let move2 = (event.clientX * 0.003);
    content.style.transform = `translateX(-${move2}%)`;
    protos.forEach((proto) => {
       proto.style.transform = `translateX(${move}%)`;
    })
});
