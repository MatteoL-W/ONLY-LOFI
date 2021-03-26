@extends('template')

@section('content')

    <div class="grid_avatar user__grid">

        <div class="user__grid-image border-bleu-droit" style="background-image:url('{{$user->avatar}}')">

        </div>

        <div class="user__grid-text">
            @if (Auth::id() == $user->id)
                <h2>You ({{$user->name}})</h2>
                <a class='wanna_update' href='/account'>want to update your profile ?</a>
            @else
                <h2>{{$user->name}}</h2>
            @endif
            <p>{{$user->description}}</p>
            <div class="user__grid-text_redirect">
            @if ($user->youtube !== '')
                <a href="{{$user->youtube}}" class='bouton-bleu youtube'>SEE YOUTUBE <i class="icon-fleche"></i></a>
            @endif

            @if ($user->soundcloud !== '')
            <a href="{{$user->soundcloud}}" class='bouton-bleu soundcloud'>SEE SOUNDCLOUD <i class="icon-fleche"></i></a>
            @endif

            @if ($user->twitter !== '')
            <a href="{{$user->twitter}}" class='bouton-bleu twitter'>SEE TWITTER <i class="icon-fleche"></i></a>
            @endif

            @if ($user->instagram !== '')
            <a href="{{$user->instagram}}" class='bouton-bleu instagram'>SEE INSTAGRAM <i class="icon-fleche"></i></a>
            @endif
                
                
                
                
            </div>
            
        </div>
        
    </div>

    @include('partials/lasts-user', ["playlists" => $playlists, "songs" => $songs])


@endsection