@extends('template')

@section('content')

    <div class="grid_avatar song">
        <div class='border-bleu-droit'>
            <img src="/assets/img_aot.png" alt="aot">
        </div>
        <div class="song__info">
            <h2>AoT but it's lofi ~ red swan</h2>
            <p>published by kurochuu.</p>

            <div class="song__info-icons">
                <a href="#" data-file="{{$songs[0]->url}}" class="song"><div id="bouton_play" class='bouton-bleu'>PLAY <i class='icon-fleche'></i></div></a>
                <i class='icon-star-empty'></i>
                <i class='icon-playlist'></i>
            </div>
        </div>
    </div>

    <div class="song_comments">
        <h2>2 comments</h2>

        <div class="comment">
            <a href="#">
                <img src="/assets/kurochuu.png" alt="">
            
                <div class="under_img">kurochuu</div>
            </a>

            <div>
                <p>Thank you so much for listening to my songs !!<br>Don't forget to like the song and add it to your playlists to support me !<br>You're the best !</p>
                <p class="comment__info">published the 08/02/2021 at 14:37</p>
            </div>
        </div>



        <div class="comment">
            <a href="#">
                <img src="/assets/lofistream.png" alt="">
            
                <div class="under_img">girl</div>
            </a>

            <div>
                <p>Nice one !</p>
                <p class="comment__info">published the 08/02/2021 at 14:37</p>
            </div>
        </div>
    </div>


@endsection