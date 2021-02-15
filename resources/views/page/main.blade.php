@extends('template')

@section('content')

    <section class="hero">

        <div class='hero__illustration border-bleu-droit'>
            <img src="/assets/book_phone.gif" alt="Illustration lo-fi" >
        </div>

        <div class='hero__text'>
            <h2>Listen to the best lo-fi freely<br>from the most valid source.</h2>
            <p>Aren't you tired of listening lo-fi on YouTube and its<br>low-quality?</p>
            
            <a href="#" class="bouton-bleu">SEE THE LIBRARY <i class='icon-fleche'></i></a>
        </div>

    </section>

    <section class="wannashare">
        <div class="wannashare__grid">

            <div class="wannashare__grid-text">
                <h2>Want to share your lo-fi ?</h2>
                <p>You can easily upload your sound and create playlists.<br>
                Then feel free to share it to your friends !</p>

                <a href="#" class="bouton-bleu">UPLOAD<i class='icon-fleche'></i></a>
            </div>

            <div class="wannashare__grid-illustration border-bleu-gauche">
                <img src="/assets/fish.gif" alt="">
            </div>

        </div>
    </section>

@endsection