<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="/css/normalize.css">
        <link rel="stylesheet" href="/fonts/icons.css">
        <link rel="stylesheet" href="/fonts/bariol.css">
        <link rel="stylesheet" href="/fonts/bahnschrift.css">
        <link rel="stylesheet" href="/css/inscription.css">

        <title>ONLY-LOFI</title>
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <div class="split">
            <div class="inscription">
                <div class="semi-header">
                    <img src="/assets/inline-logo.svg" alt="Logo ONLY-LOFI">
                </div>

                <div class="semi-form">
                    <h2 class="red-title">sign-in</h2>
                    <form class="inscription__gridform" action="" method="post">
                        <input type="text" name="pseudo" id="pseudo" placeholder="pseudo">
                        <input type="file" name="avatar" id="avatar">

                        <input type="date" name="birthday" id="birthday" placeholder="birthday">
                        <div id="remember">
                            <span>remember</span>
                            <input type="checkbox" name="checkbox" id="remember_checkbox">
                        </div>

                        <input type="password" name="pwd" id="pwd" placeholder="password">
                        <input type="password" name="pwd2" id="pwd2" placeholder="confirm password">
                        <input type="submit" value="▶" name="sign" id="sign">

                        <input type="email" name="email" id="email" placeholder="email address">

                    </form>
                </div>

                <h2 id="goToLoginBtn"class="red-title">log-in</h2>
            </div>






            <div class="connexion">
                <div class="semi-header">
                    <img src="/assets/inline-logo.svg" alt="Logo ONLY-LOFI">
                </div>

                <div class="semi-form">
                    <h2 class="red-title">log-in</h2>
                    <form class="connexion__gridform" action="" method="post">
                        <input type="nickname" name="nickname" id="nickname" placeholder="nickname">
                        <input type="password" name="password" id="password" placeholder="password">

                        <input type="submit" value="▶" name="log" id="log">
                    </form>
                </div>

                <h2 id="goToSignInBtn"class="red-title">sign-in</h2>
            </div>

            <div id="moving-image" class='log-in'>
            </div>

            <div id="fixed-bar">

            </div>
        
        <script src="/script/inscription.js" async defer></script>
    </body>
</html>
