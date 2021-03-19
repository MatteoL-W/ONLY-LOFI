@extends('template')

@section('content')

    <div class="grid_avatar song">
        <div class='border-bleu-droit'>
            <img src="{{$song->img}}" alt="{{$song->title}}">
        </div>
        <div class="song__info">
            <h2>{{$song->title}}</h2>
            <p>published by <a href="/user/{{$song->user_id}}">{{$artist[0]->name}}</a>.</p>
            

            <div class="song__info-icons">
                <a href="#" data-file="{{$song->url}}" class="song"><div id="bouton_play" class='bouton-bleu'>PLAY <i class='icon-fleche'></i></div></a>
                <i class='icon-star-empty'></i>
                <i class='icon-playlist'></i>
            </div>
        </div>
    </div>

    <div class="song_comments">
        
        <h2>{{$nbComments}} comments</h2>

        @foreach ($comments as $comment)

            <div class="comment">
                <a href="#">
                    <img src="/assets/kurochuu.png" alt="">
                
                    <div class="under_img">{{$comment->name}}</div>
                </a>

                <div>
                    <p>{{$comment->content}}</p>
                    <p class="comment__info">published the {{$comment->created_at}}</p>
                </div>
            </div>

        @endforeach

        <form action="" method="post" class="comments">
            @csrf
            <h2>Post a comment</h2>
            <textarea name="content" id="content"></textarea>
            <input type="submit" value="Submit →" class='bouton-bleu'>
        </form>

    </div>


@endsection