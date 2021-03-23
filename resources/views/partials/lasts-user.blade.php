<section id="last-user">
    <div>
        <h2>Lasts playlists</h2>
        <ol class='border-gauche'>
            @foreach ($playlists as $playlist)
                <li><a href="/playlist/{{$playlist->id}}">{{$playlist->title}}</span></a></li>
            @endforeach
        </ol>
    </div>
    <div>
        <h2>Lasts songs</h2>
        <ol class='border-gauche'>
            @foreach ($songs as $song)
                <li><a href="/song/{{$song->id}}">{{$song->title}}</span></a></li>
            @endforeach
        </ol>
    </div>

</section>