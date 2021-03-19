@extends('template')

@section('content')

    <div class="grid_avatar user__grid">

        <div class="user__grid-image border-bleu-droit" style="background-image:url('/assets/kurochuu.png')";>

        </div>

        <div class="user__grid-text">
            <h2>{{$user->name}}</h2>
            <p>{{$user->description}}</p>
            <div class="user__grid-text_redirect">
            @if ($user->youtube !== '')
                <a href="{{$user->youtube}}" class='bouton-bleu youtube'>SEE YOUTUBE <i class="icon-fleche"></i></a>
            @endif

            @if ($user->soundcloud !== '')
            <a href="##" class='bouton-bleu soundcloud'>SEE SOUNDCLOUD <i class="icon-fleche"></i></a>
            @endif

            @if ($user->twitter !== '')
            <a href="##" class='bouton-bleu twitter'>SEE TWITTER <i class="icon-fleche"></i></a>
            @endif

            @if ($user->instagram !== '')
            <a href="##" class='bouton-bleu instagram'>SEE INSTAGRAM <i class="icon-fleche"></i></a>
            @endif
                
                
                
                
            </div>
            
        </div>
        
    </div>

    @include('partials/lasts-user')


@endsection