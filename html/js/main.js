let stars = document.querySelectorAll('.star');


window.onload = function(e) {
    for (let i = 0; i < note; i++) {
        stars[i].classList.add('yellow');
    }
};
