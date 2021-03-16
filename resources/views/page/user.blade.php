@extends('template')

@section('content')

    <div class="grid_avatar user__grid">

        <div class="user__grid-image border-bleu-droit" style="background-image:url('/assets/kurochuu.png')";>

        </div>

        <div class="user__grid-text">
            <h2>Chilled Cow</h2>
            <p>Producer and lo-fi leaker ! Got a YouTube channel about lo-fi !</p>
            <div class="user__grid-text_redirect">
                <a href="##" class='bouton-bleu youtube'>SEE YOUTUBE <i class="icon-fleche"></i></a>
                <a href="##" class='bouton-bleu soundcloud'>SEE SOUNDCLOUD <i class="icon-fleche"></i></a>
                <a href="##" class='bouton-bleu twitter'>SEE TWITTER <i class="icon-fleche"></i></a>
                <a href="##" class='bouton-bleu instagram'>SEE INSTAGRAM <i class="icon-fleche"></i></a>
            </div>
            
        </div>
        
    </div>

    @include('partials/lasts-user')


@endsection