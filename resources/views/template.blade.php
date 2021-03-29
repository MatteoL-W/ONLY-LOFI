<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="/css/normalize.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="/fonts/icons.css">
    <link rel="stylesheet" href="/fonts/bariol.css">
    <link rel="stylesheet" href="/fonts/bahnschrift.css">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/toastr.css">

    <title>ONLY-LOFI</title>
</head>
<body>
    
    <header>
        <div class='header__left'><a href="/"><img src="/assets/inline-logo.svg" alt="Logo ONLYLOFI" class='header__left-logo'></a></div>
        <div class='header__right'>
            
            <form method="get" action="/search" id="search">
                <input type="search" name="search" id="search" class='header__right-search' placeholder="Search anything...">
                <input type="submit" value="→">
            </form>

            <div class="header__right-burger">
                <div></div>
                <div></div>
            </div>
        </div>
    </header>
    @include('partials.audioplayer')

    <div id="menu" class='menu'>
        <div class="menu__grid">
            <div class="menu__grid-links">
                <a href="/" class='links-main' data-tilt data-tilt-max="10">Main page <div><i class='icon-music'></i></div></a>
                <a href="/song" class='links-library' data-tilt data-tilt-max="10">Library <div><i class='icon-playlist'></i></div></a>
                <a href="/upload" class='links-upload' data-tilt data-tilt-max="10">Upload <div><i class='icon-triangle'></i></div></a>
                <a href="/account" class='links-myacc' data-tilt data-tilt-max="10">My account <div><i class='icon-avatar'></i></div></a>
                <a href="{{ route('logout') }}" class='links-disconnect' data-tilt data-tilt-max="10" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Disconnect <div><i class='icon-fleche'></i></div></a>
            </div>

            <form style="display: none;" id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
    </div>

    <div id="pjax-container">
        @yield('content')
    </div>

    <div id="hover__circle">
        see more<br><i class='icon-fleche'></i>
    </div>

    
    
    <footer class="footer">
        <div class="footer__network">
            <h2>Follow us on our networks</h2>
            <div class="footer__network-icons">
                <a href="href">
                    <img src="/assets/twitter.png" alt="Logo twitter">
                </a>

                <a href="href">
                    <img src="/assets/ytb.png" alt="Logo twitter">
                </a>

                <a href="href">
                    <img src="/assets/fb.png" alt="Logo twitter">
                </a>
            </div>
        </div>
    </footer>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.6.0/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.6.0/ScrollTrigger.min.js"></script>
    <script src="https://kit.fontawesome.com/721a596d94.js" crossorigin="anonymous"></script>
    <script src="/script/vanilla-tilt.min.js"></script>
    <script src="/script/menu.js"></script>
    <script src="/script/hover_circle.js"></script>
    <script src="/script/jquery.pjax.js"></script>
    <script src="/script/toastr.min.js"></script>
    <script src="/script/app.js"></script>
</body>
</html>