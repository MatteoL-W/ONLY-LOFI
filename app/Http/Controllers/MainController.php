<?php

namespace App\Http\Controllers;

use App\Models\Song;
use App\Models\User;
use App\Models\Comment;
use App\Models\Listened;
use App\Models\Playlist;
use App\Models\PlaylistSong;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class MainController extends Controller
{

    public function main() {
        return view("page.main");
    }

    public function upload() {
        return view("page.upload");
    }

    public function song() {
        // DISTINCT FIX
        $PlastsListened = Playlist::join('listened', 'idListened', '=', 'playlist.id')->where('idListener','=', Auth::id())->where('playlist','=', 1)->limit(4)->get()->sortByDesc('updated_at');
        $PlastsCreated = Playlist::where('user_id','=', Auth::id())->limit(4)->get()->sortByDesc('playlist.id');
        $SlastsListened = Song::join('listened', 'idListened', '=', 'song.id')->where('idListener','=', Auth::id())->where('playlist','=', 0)->limit(4)->get()->sortByDesc('updated_at');
        return view("page.library", ["PlastsListened" => $PlastsListened, "PlastsCreated" => $PlastsCreated, "SlastsListened" => $SlastsListened]);
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
        
        return view("page.song", ["song" => $song, "artist" => $uploaderName, "comments" => $comments, "nbComments" => $nbComments, "playlist" => false]);
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
        $social = ['youtube', 'soundcloud', 'twitter', 'instagram'];
        return view("page.user", ["user" => $user, "social" => $social]);
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
}
