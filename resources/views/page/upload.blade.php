@extends('template')

@section('content')

    <div class="grid_avatar upload__grid">
        <div class="upload__grid-image border-bleu-droit">
            <img src="/assets/img_upload.png" alt="Upload image">
        </div>
        <div class="upload__grid-upload">
            <form action="">
                <h2>Upload your song</h2>
                <input type="text" name="song_title" id="song_title" placeholder="song title">
                <div id="redirect_file"><span>your song</span><i class='icon-music'></i></div>

                <input type="file" name="song_file" id="song_file">
                <input type="submit" value="SUBMIT      →" class="bouton-bleu">
            </form>
        </div>
    </div>


@endsection