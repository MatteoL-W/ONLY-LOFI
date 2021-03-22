@extends('template')

@section('content')

    @if (count($PlastsListened) != 0)
        <div class="container" style='margin-top: 50px'>
            <h2>Hello {{ Auth::user()->name }}, here are your last playlists listened</h2>
            @include('partials/last4', ["collection" => $PlastsListened])
        </div>
    @endif

    <section class="hero">

        <div class='hero__illustration border-bleu-droit'>
            <img src="/assets/book_phone.gif" alt="Illustration lo-fi" >
        </div>

        <div class='hero__text'>
            <h2>Listen to the best lo-fi freely<br>from the most valid source.</h2>
            <p>Aren't you tired of listening lo-fi on YouTube and its<br>low-quality?</p>
            
            <a href="song" class="bouton-bleu">SEE THE LIBRARY <i class='icon-fleche'></i></a>
        </div>

    </section>

    <section class="wannashare">
        <div class="wannashare__grid">

            <div class="wannashare__grid-text">
                <h2>Want to share your lo-fi ?</h2>
                <p>You can easily upload your sound and create playlists.<br>
                Then feel free to share it to your friends !</p>

                <a href="upload" class="bouton-bleu">UPLOAD<i class='icon-fleche'></i></a>
            </div>

            <div class="wannashare__grid-illustration border-bleu-gauche">
                <img src="/assets/fish.gif" alt="">
            </div>

        </div>
    </section>

@endsection