<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="/css/normalize.css">
    <link rel="stylesheet" href="/fonts/icons.css">
    <link rel="stylesheet" href="/fonts/bariol.css">
    <link rel="stylesheet" href="/fonts/bahnschrift.css">
    <link rel="stylesheet" href="/css/style.css">

    <title>ONLY-LOFI</title>
</head>
<body>
    <header>
        <div class='header__left'><img src="/assets/inline-logo.svg" alt="Logo ONLYLOFI" class='header__left-logo'></div>
        <div class='header__right'>
            <input type="search" name="" id="" class='header__right-search'>
            <div class="header__right-burger">
                <div></div>
                <div></div>
            </div>
        </div>
    </header>

    <div id="menu" class='menu'>
        <div class="menu__grid">
            <div class="menu__grid-links">
                <a href="#" class='links-main' data-tilt data-tilt-max="10">Main page <div><i class='icon-music'></i></div></a>
                <a href="#" class='links-library' data-tilt data-tilt-max="10">Library <div><i class='icon-playlist'></i></div></a>
                <a href="#" class='links-upload' data-tilt data-tilt-max="10">Upload <div><i class='icon-triangle'></i></div></a>
                <a href="#" class='links-myacc' data-tilt data-tilt-max="10">My account <div><i class='icon-avatar'></i></div></a>
                <a href="#" class='links-disconnect' data-tilt data-tilt-max="10">Disconnect <div><i class='icon-fleche'></i></div></a>
            </div>
        </div>
    </div>

@yield('content')

    <footer>
        footer <i class='icon-music'></i>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.6.0/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.6.0/ScrollTrigger.min.js"></script>
    <script src="/script/vanilla-tilt.min.js"></script>
    <script src="/script/menu.js"></script>
    <script src="/script/hover_circle.js"></script>
</body>
</html>