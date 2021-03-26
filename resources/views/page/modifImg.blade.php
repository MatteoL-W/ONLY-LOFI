@extends('template')

@section('content')

<div class="grid_avatar upload__grid">
    <div class="upload__grid-image border-bleu-droit">
        <img src="{{$changing->img}}" alt="Upload image">
    </div>
    <div class="upload__grid-upload">
        <form method="POST" action="" enctype="multipart/form-data">
            @CSRF
            <h2>Modify the image of {{$changing->title}}</h2>
            
            <label for="avatar_file" id="label_avatar_file">
                <div id="redirect_file"><span>Your avatar</span><i class='icon-avatar'></i></div>
            </label>
            <input type="file" name="avatar_file" id="avatar_file" accept="image/png, image/jpeg">

            <input type="submit" value="SUBMIT      →" class="bouton-bleu">
        </form>
    </div>
</div>

@endsection