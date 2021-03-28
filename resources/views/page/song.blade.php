@extends('template')

@php

$nb = 0;

@endphp


@section('content')

<div class="grid_avatar song">
    <div class='border-bleu-droit'>
        <img src="{{$song->img}}" alt="{{$song->title}}">
        @if ($playlist === false)
            @if ($song->user_id == Auth::id())
            <a href="/modifImage/song/{{$song->id}}" class="modify">Modify this image</a>
            @endif
        @else
            @if ($song->user_id == Auth::id())
            <a href="/modifImage/playlist/{{$song->id}}" class="modify">Modify this image</a>
            @endif
        @endif
    </div>
    <div class="song__info">
        <h2>{{$song->title}}</h2>
        <p>published by <a href="/user/{{$song->user_id}}">{{$artist[0]->name}}</a> @if ($playlist === false) / {{$nbLikes}} likes - {{$nbPlays}} plays @endif </p>
        @if ($playlist === false)
            @if ($song->user_id == Auth::id())
                <p><a href="/delete/song/{{$song->id}}">Delete this song</a></p>
            @endif
        @else
            @if ($song->user_id == Auth::id())
                <p><a href="/delete/playlist/{{$song->id}}">Delete this song</a></p>
            @endif
        @endif

        <div class="song__info-icons">
        @if ($playlist === true)
            <a href="#" data-file="/render/{{ $playlistContent[0]->idsong }}{{substr($playlistContent[0]->url, 10)}}" data-nb="{{0}}" data-title="{{$playlistContent[0]->title}}" data-artist="{{$playlistContent[0]->name}}" data-playlist="1" data-listened="{{$song->id}}" class='song'>
                <div id="bouton_play" class='bouton-bleu'>PLAY <i class='icon-fleche'></i></div>
            </a> 
            @foreach ($playlistContent as $songFP)
                <a href="#" data-file="/render/{{ $songFP->idsong }}{{substr($songFP->url, 10)}}" data-title="{{$songFP->title}}" data-artist="{{$songFP->name}}" class='songlist'></a>
            
            @endforeach

        @else
            <a href="#" data-file="/render/{{ $song->id }}{{substr($song->url, 10)}}" data-nb="{{$nb++}}" data-title="{{$song->title}}" data-artist="{{$artist[0]->name}}" class="song">
                <div id="bouton_play" class='bouton-bleu'>PLAY <i class='icon-fleche'></i></div>
            </a> 
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
                    <li>
                    <a href="#" data-file="/render/{{ $songFP->idsong }}{{substr($songFP->url, 10)}}" data-nb='{{$nb++}}' data-title="{{$songFP->title}}" data-artist="{{$songFP->name}}" class="song">
                        <div id="bouton_play" class='fas fa-play'></div>
                    </a>  

                    <a href="/song/{{$songFP->idsong}}"><b>{{$songFP->title}}</b> by {{$songFP->name}}</a>
                        @if (Auth::id() == $songFP->user_id)
                            <a href="/deleteFromPlaylist/{{$song->id}}/{{$songFP->idsong}}"><b>- delete from the playlist</b></a>
                        @endif

                    </li>
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
                <a href="/user/{{$comment->id}}">
                    <img src="{{$comment->avatar}}" alt="">

                    <div class="under_img">{{$comment->name}}</div>
                </a>

                <div>
                    <p>{{$comment->content}}</p>
                    <p class="comment__info">published the {{$comment->when}}
                    @if ($comment->id == Auth::id())
                     | <a href='/deleteComment/{{$comment->idComment}}'>Delete my comment</a>
                    @endif
                    </p>
                    

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