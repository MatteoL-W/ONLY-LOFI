@extends('template')

@section('content')

    <div class="grid_avatar upload__grid">
        <div class="upload__grid-image border-bleu-droit">
            <img src="/assets/img_upload.png" alt="Upload image">
        </div>
        <div class="upload__grid-upload">
            <form method="POST" action="/upload/new" enctype="multipart/form-data">
            @CSRF
                <h2>Upload your song</h2>
                <input type="text" name="song_title" id="song_title" placeholder="Song title - Artist">
                <label for="song_file" id="label_song_file"><div id="redirect_file"><span>Your song</span><i class='icon-music'></i></div></label>

                <input type="file" name="song_file" id="song_file" accept="audio/mp3, audio/ogg">
                <input type="submit" value="SUBMIT      →" class="bouton-bleu">
            </form>
        </div>
    </div>


@endsection