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
            <a href="#" data-file="{{$song->url}}" class="song">
                <div id="bouton_play" class='bouton-bleu'>PLAY <i class='icon-fleche'></i></div>
            </a>      
            @if ($playlist === false)
                @auth
                        @if(Auth::user()->ILikeThem->contains($song->id))
                            <a href="/changeLike/{{$song->id}}"><i class='icon-star'></i></a>
                        @else
                            <a href="/changeLike/{{$song->id}}"><i class='icon-star-empty'></i></a>
                        @endif
                @endauth

                
                
                <a id="addButton"><i class='icon-playlist'></i></a>
                
                @include('partials/addToPlaylist', ['idSong' => $song->id])
            @endif
        </div>

    </div>
</div>

@if ($playlist === true)

    <section class='songsFromPlaylist'>

        <div class="border-gauche">

            <ol>

                @foreach ($playlistContent as $songFP)
                    <li><a href="/song/{{$songFP->idsong}}"><b>{{$songFP->title}}</b> by {{$songFP->name}}</li></a>
                @endforeach

            </ol>

        </div>

    </section>

@endif

@if ($playlist === false)

    <div class="song_comments">

        @if ($nbComments == 0)
        <h2>No comments here... What about posting one ?</h2>
        @elseif ($nbComments == 1)
        <h2>{{$nbComments}} comment</h2>
        @else
        <h2>{{$nbComments}} comments</h2>
        @endif

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
@endif

@endsection