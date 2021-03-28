<div id="bloc_playlist">
    <a href="/createPlaylist">Créer une nouvelle playlist <i class='icon-fleche'></i></a>
    
    @foreach ($allPlaylists as $playlist)
    <a href="/addToPlaylist/{{$playlist->id}}/{{$idSong}}"><i class='icon-triangle'></i>{{$playlist->title}}</a>
    @endforeach
</div>