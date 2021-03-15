<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

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
                    <div class="top-form">
                        <h2 class="red-title">sign-in</h2>
                        <i class='icon-info-circled' id='sign-info'></i>
                    </div>

                    <form class="inscription__gridform" action="{{ route('register') }}" method="post">
                        @csrf

                        <input type="text" name="pseudo" id="pseudo" placeholder="pseudo">
                        @error('pseudo')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <input type="file" name="avatar" id="avatar" class='more_info'>

                        <input type="date" name="birthday" id="birthday" class='more_info'>
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
                    <form class="connexion__gridform" action="register" method="post">
                        @csrf
                        <input type="text" name="nickname" id="nickname" placeholder="nickname">
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









<!--<form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>-->
