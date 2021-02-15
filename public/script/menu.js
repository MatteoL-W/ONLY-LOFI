let body = document.querySelector('body');
let boutonBurger = document.querySelector('.header__right-burger');
let menu = document.querySelector('#menu');

boutonBurger.addEventListener('click', () => {
    body.classList.toggle('full-width');
    boutonBurger.classList.toggle("active");
    menu.classList.toggle("active");
});