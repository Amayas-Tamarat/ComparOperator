let star = document.querySelector('.star');
let note = 4;

window.onload = function(e) {
    for (let i = 0; i < note; i++) {
        star[i].classList.add('yellow');
    }
};