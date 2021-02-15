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
                <a href="#">Main page</a>
                <a href="#">Library</a>
                <a href="#">Upload</a>
                <a href="#">My account</a>
                <a href="#">Disconnect</a>
            </div>
            <div class="menu__grid-illustration border-rouge-gauche">
                <img src="/assets/briquet.png" alt="Briquet">
            </div>
        </div>
    </div>

@yield('content')

    <footer>
        footer <i class='icon-music'></i>
    </footer>
    <script src="/script/menu.js"></script>
</body>
</html>