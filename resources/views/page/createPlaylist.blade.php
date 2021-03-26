@extends('template')

@section('content')

<div class="grid_avatar upload__grid">
        <div class="upload__grid-image border-bleu-droit">
            <img src="/assets/img_upload.png" alt="Upload image">
        </div>
        <div class="upload__grid-upload">
            <form method="POST" action="/createPlaylist" enctype="multipart/form-data">
            @CSRF
                <h2>Create your playlist</h2>
                <input type="text" name="playlist_title" id="playlist_title" placeholder="Playlist title">
                
                <label for="avatar_file" id="label_avatar_file"><div id="redirect_file"><span>Playlist image</span><i class='icon-avatar'></i></div></label>
                <input type="file" name="avatar_file" id="avatar_file" accept="image/png, image/jpeg">

                <input type="file" name="song_file" id="song_file" accept="audio/mp3, audio/ogg">
                <input type="submit" value="SUBMIT      →" class="bouton-bleu">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
            </form>
        </div>
    </div>


@endsection