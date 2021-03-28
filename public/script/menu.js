/* ACTIVATION MENU */

let body = document.querySelector('body');
let boutonBurger = document.querySelector('.header__right-burger');
let menu = document.querySelector('#menu');

boutonBurger.addEventListener('click', () => {
    body.classList.toggle('full-width');
    boutonBurger.classList.toggle("active");
    menu.classList.toggle("active");
});

/* ANIMATION A DROITE DES LIENS */

let menuParent = document.querySelector('.menu__grid-links');
let enfants = menuParent.childNodes;

/* première boucle, on cherche tous les liens */
enfants.forEach( (parent) => {
    
    parent.addEventListener('mousemove', (e) => {

        /* coordonnées de la souris */
        let x = e.pageX;
        let y = e.pageY;

        /* deuxième boucle, on cherche tous les carrés (div) */
        

    })

    parent.addEventListener('click', () => {
        body.classList.toggle('full-width');
        boutonBurger.classList.toggle("active");
        menu.classList.toggle("active");
    })
})

$('#search').on('submit', function (e) {
    e.preventDefault();
    window.location.href = "/search/" + e.target.elements[0].value;
})