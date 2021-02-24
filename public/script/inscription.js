document.querySelector('#goToSignInBtn').addEventListener('click', () => {
    document.querySelector('#moving-image').classList.remove('log-in');
    document.querySelector('#moving-image').classList.add('sign-in');

    document.querySelector('#fixed-bar').classList.add('is-moving-right');
    setTimeout(() => {
        document.querySelector('#fixed-bar').classList.remove('is-moving-right');
    }, 1000)
});

document.querySelector('#goToLoginBtn').addEventListener('click', () => {
    document.querySelector('#moving-image').classList.remove('sign-in');
    document.querySelector('#moving-image').classList.add('log-in');
    document.querySelector('#moving-image').classList.add('is-moving');
    document.querySelector('#fixed-bar').classList.add('is-rotating');
    setTimeout(() => {
        document.querySelector('#moving-image').classList.remove('is-moving');
        document.querySelector('#fixed-bar').classList.remove('is-rotating');
    }, 1000)
});



let boutonInfo = document.querySelector('#sign-info');

boutonInfo.addEventListener('click', () => {
    boutonInfo.classList.toggle("active");
    document.querySelectorAll('.more_info').forEach((item) => {
        item.classList.toggle('info_active');
    })
});