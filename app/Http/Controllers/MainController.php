<?php

namespace App\Http\Controllers;

use App\Models\Song;
use App\Models\User;
use App\Models\Comment;
use App\Models\Playlist;
use App\Models\PlaylistSong;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class MainController extends Controller
{

    public function main() {
        $PlastsListened = Playlist::select('*','playlist.id as idPlaylist')->join('listened','idListened', '=', 'playlist.id')->where('playlist.user_id','=', Auth::id())->where('playlist','=', 1)->orderBy('listened.id', 'DESC')->limit(4)->get();
        $PlastsListened = $PlastsListened->unique('idPlaylist');

        return view("page.main", ["PlastsListened" => $PlastsListened]);
    }

    public function upload() {
        return view("page.upload");
    }

    public function account() {
        return view("page.account");
    }

    public function likes() {
        $allLikes = Song::select('*')->join('likes','idSong','=','song.id')->where('idLikeur','=', Auth::id())->orderBy('likes.id', 'DESC')->get();
        return view("page.defaultAll", ["collection" => $allLikes, "intitule" => "Your likes"]);
    }

    public function playlists() {
        $playlists = Playlist::select('*','playlist.id as idPlaylist')->where('user_id','=', Auth::id())->limit(4)->orderBy('playlist.id', 'DESC')->get();
        return view("page.defaultAll", ["collection" => $playlists, "intitule" => "Your playlists created"]);
    }

    public function song() {
             
        $PlastsListened = Playlist::select('*','playlist.id as idPlaylist')->join('listened','idListened', '=', 'playlist.id')->where('playlist.user_id','=', Auth::id())->where('playlist','=', 1)->orderBy('listened.id', 'DESC')->limit(4)->get();
        $PlastsListened = $PlastsListened->unique('idPlaylist');

        $PlastsCreated = Playlist::select('*','playlist.id as idPlaylist')->where('user_id','=', Auth::id())->limit(4)->orderBy('playlist.id', 'DESC')->get();

        $SlastsListened = Song::select('*','song.id as idSong')->join('listened', 'idListened', '=', 'song.id')->where('idListener','=', Auth::id())->where('playlist','=', 0)->limit(4)->orderBy('listened.id', 'DESC')->get();
        $SlastsListened = $SlastsListened->unique('idSong');
        
        $SlastsLikes = Song::select('*')->join('likes','idSong','=','song.id')->where('idLikeur','=', Auth::id())->orderBy('likes.id', 'DESC')->limit(4)->get();

        return view("page.library", ["PlastsListened" => $PlastsListened, "PlastsCreated" => $PlastsCreated, "SlastsListened" => $SlastsListened, "SlastsLikes" => $SlastsLikes]);
    }

    public function store(Request $request) {
        $song = new Song();
        $song->title = $request->input('title');
        $song->url = $request->input('url');
        $song->votes = 0;
        $song->user_id = Auth::id();
        $song->save();

        return redirect("upload");
    }

    public function songId($id) { 
        $song = Song::findOrFail($id);
        $uploaderName = User::select('name')->where('id', '=', $song->user_id)->get();
        
        $comments = Comment::join('users','comments.idWriter', '=', 'users.id')->where('idPost', '=', $id)->get();
        $nbComments = count($comments);

        $allPlaylists = Playlist::select('id','title')->where('user_id','=', Auth::id())->get();
        
        return view("page.song", ["song" => $song, "artist" => $uploaderName, "comments" => $comments, "nbComments" => $nbComments, "playlist" => false, "allPlaylists" => $allPlaylists]);
    }

    public function playlistId($id) { 
        $playlist = Playlist::findOrFail($id);
        $uploaderName = User::select('name')->where('id', '=', $playlist->user_id)->get();

        $playlistContent = [];
        $artists = [];
        $playlistContentTable = PlaylistSong::all()->where('idPlaylist', '=', $id);

        foreach ($playlistContentTable as $songs) {
            array_push($playlistContent, Song::select('*','song.id AS idsong')->join('users', 'song.user_id', '=', 'users.id')->where('song.id', '=', $songs->idSong)->first());
        }

        return view("page.song", ["song" => $playlist, "artist" => $uploaderName, "comments" => "none", "nbComments" => "none", "playlist" => true, "playlistContent" => $playlistContent]);
    }

    public function user() {
        return view("page.user");
    }

    public function userId($id) {
        $user = User::findOrFail($id);
        $playlists = Playlist::select('id', 'title')->where('user_id', '=', $id)->limit(4)->get();
        $songs = Song::select('id', 'title')->where('user_id', '=', $id)->limit(4)->get();
        $social = ['youtube', 'soundcloud', 'twitter', 'instagram'];
        return view("page.user", ["user" => $user, "social" => $social, "playlists" => $playlists, "songs" => $songs]);
    }

    public function addComment($id, Request $request) {
        $request->validate([
            'content' => 'required|min:7|max:500',
        ]);

        $comment = new Comment();
        $comment->idWriter = Auth::id();
        $comment->idPost = $id;
        $comment->content = $request->input('content');
        $comment->save();

        return redirect("/song/$id");

    }

    public function search($search) {
        $songs = Song::whereRaw("title LIKE CONCAT('%', ?, '%')", [$search])->get();
        $playlists = Playlist::whereRaw("title LIKE CONCAT('%', ?, '%')", [$search])->get();
        $users = User::whereRaw("name LIKE CONCAT('%', ?, '%')", [$search])->get();

        return view('page.search', ['search' => $search, 'users' => $users, 'songs' => $songs, 'playlists' => $playlists]);
    }

    public function changeLike($id) {
        Auth::user()->ILikeThem()->toggle($id);
        return back();
    }

    public function addToPlaylist($idPlaylist, $idSong) {

        $playlistSong = new PlaylistSong();
        $playlistSong->idPlaylist = $idPlaylist;
        $playlistSong->idSong = $idSong;
        $playlistSong->save();

        return redirect("/song/$idPlaylist");
    }
}
