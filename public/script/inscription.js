document.querySelector('#goToSignInBtn').addEventListener('click', () => {
    document.querySelector('#moving-image').classList.remove('log-in');
    document.querySelector('#moving-image').classList.add('sign-in');
})

document.querySelector('#goToLoginBtn').addEventListener('click', () => {
    document.querySelector('#moving-image').classList.remove('sign-in');
    document.querySelector('#moving-image').classList.add('log-in');
})