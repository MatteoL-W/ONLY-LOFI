if (window.location.href.includes('/song/')) {
    document.querySelector('#addButton').addEventListener('click', (e) => {
        let dimensionBouton = document.querySelector('#addButton').getBoundingClientRect();
        e.preventDefault();

        document.querySelector('#bloc_playlist').classList.toggle('active');
        console.log(dimensionBouton.x);

        document.querySelector('#bloc_playlist').style.left = dimensionBouton.x + 72 + "px";
        document.querySelector('#bloc_playlist').style.top = dimensionBouton.y + "px";
    })
}