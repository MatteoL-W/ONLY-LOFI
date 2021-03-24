if (window.location.href.includes('/song/')) {
    document.querySelector('#addButton').addEventListener('click', (e) => {
        e.preventDefault();
        document.querySelector('#bloc_playlist').classList.toggle('active');
        
    })
}