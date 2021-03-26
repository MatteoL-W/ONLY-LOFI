@extends('template')

@section('content')

    <div class="grid_avatar upload__grid">
        <div class="upload__grid-image border-bleu-droit">
        @if ( $user->avatar == "" )
            <img src="/assets/img_upload.png" alt="Upload image">
        @else 
            <img src="{{$user->avatar}}" alt="Your avatar">
        @endif
        </div>
        <div class="upload__grid-upload">
            <form method="POST" action="/account/infos" enctype="multipart/form-data">
                @CSRF
                <h2>Update my account</h2>
                <a class="wanna_update" href="/user/{{$user->id}}">want to see your page ?</a>
                <input type="text" name="email" id="email" placeholder="Your email" value="{{$user->email}}">
                <input type="date" name="birthday" id="birthday" value="{{$user->birthday}}">

                <label for="avatar_file" id="label_avatar_file"><div id="redirect_file"><span>Your avatar</span><i class='icon-avatar'></i></div></label>
                <input type="file" name="avatar_file" id="avatar_file" accept="image/png, image/jpeg">

                <input type="password" name="pwd" id="pwd" placeholder="Password">
                <input type="password" name="pwd_confirmation" id="pwd_confirmation" placeholder="Password confirmation">
                <input type="submit" value="SUBMIT      →" class="bouton-bleu">
            </form>
        </div>
    </div>

    <form action="/account/networks" method="POST" class="update_info">
        @CSRF
        <h2>Update your informations</h2>
        <textarea name="description">{{$user->description}}</textarea>
        <div class="container">
            <input name="youtube" type="text" class="network-input youtube" placeholder="change Youtube link" value="{{$user->youtube}}">
            <input name="soundcloud" type="text" class="network-input soundcloud" placeholder="change Soundcloud link" value="{{$user->soundcloud}}">
            <input name="twitter" type="text" class="network-input twitter" placeholder="change Twitter link" value="{{$user->twitter}}">
            <input name="instagram" type="text" class="network-input instagram" placeholder="change Instagram link" value="{{$user->instagram}}">
        </div>
        <input type="submit" value="SUBMIT      →" class="bouton-bleu">
    </form>


@endsection