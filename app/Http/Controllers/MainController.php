<?php

namespace App\Http\Controllers;

use App\Models\Song;
use App\Models\User;
use App\Models\Comment;
use App\Models\Listened;
use App\Models\Likes;
use App\Models\Playlist;
use App\Models\PlaylistSong;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Response;


class MainController extends Controller
{

    public function main() {
        $PlastsListened = Playlist::select('*','playlist.id as idPlaylist')->join('listened','idListened', '=', 'playlist.id')->where('playlist.user_id','=', Auth::id())->where('playlist','=', 1)->orderBy('listened.id', 'DESC')->limit(4)->get();
        $PlastsListened = $PlastsListened->unique('idPlaylist');

        return view("page.main", ["PlastsListened" => $PlastsListened]);
    }

    public function upload() {
        $user = Auth::user();
        return view("page.upload", ["user" => $user]);
    }

    public function account() {
        $user = User::findOrFail(Auth::id());
        return view("page.account", ['user' => $user]);
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
        $PlastsListened = Playlist::select('*','playlist.id as idPlaylist')->join('listened','idListened', '=', 'playlist.id')->where('playlist.user_id','=', Auth::id())->where('playlist','=', 1)->orderBy('listened.id', 'DESC')->limit(2)->get();
        $PlastsListened = $PlastsListened->unique('idPlaylist');

        $PlastsCreated = Playlist::select('*','playlist.id as idPlaylist')->where('user_id','=', Auth::id())->limit(2)->orderBy('playlist.id', 'DESC')->get();


        $PlastlyListened = Playlist::select('*','playlist.id as idPlaylist')->join('listened','idListened', '=', 'playlist.id')->where('playlist','=', 1)->orderBy('listened.updated_at', 'DESC')->limit(4)->get();
        $PlastlyListened = $PlastlyListened->unique('idPlaylist');


        $SlastsListened = Song::select('*','song.id as idSong')->join('listened', 'idListened', '=', 'song.id')->where('idListener','=', Auth::id())->where('playlist','=', 0)->limit(4)->orderBy('listened.id', 'DESC')->get();
        $SlastsListened = $SlastsListened->unique('idSong');
        
        $SlastsLikes = Song::select('*')->join('likes','idSong','=','song.id')->where('idLikeur','=', Auth::id())->orderBy('likes.id', 'DESC')->limit(4)->get();

        return view("page.library", ["PlastsListened" => $PlastsListened, "PlastsCreated" => $PlastsCreated, "PlastlyListened" => $PlastlyListened, "SlastsListened" => $SlastsListened, "SlastsLikes" => $SlastsLikes]);
    }

    public function store(Request $request) {

        $request->validate([
            'song_title' => "required|min:4|max:255",
            'song_file' => 'required|file|mimes:mp3,ogg',
            'avatar_file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $name = $request->file('song_file')->hashName();
        $request->file('song_file')->move("uploads/".Auth::id(), $name);

        $avatarName = Auth::user()->id.'_song'.$request->input('song_title').'.'.request()->avatar_file->getClientOriginalExtension();
        $request->file('avatar_file')->storeAs('public',$avatarName);

        $song = new Song();
        $song->title = $request->input('song_title');
        $song->url = "/uploads/".Auth::id()."/".$name;

        $song->img = "/storage/".$avatarName;
        $song->user_id = Auth::id();

        $song->save();

        return redirect("/song/" . $song->id);
    }

    public function songId($id) { 
        $song = Song::findOrFail($id);
        $uploaderName = User::select('name')->where('id', '=', $song->user_id)->get();
        
        $comments = Comment::select('*', 'comments.updated_at as when', 'comments.id as idComment')->join('users','comments.idWriter', '=', 'users.id')->where('idPost', '=', $id)->get();
        $nbComments = count($comments);

        $nbLikes = count(Likes::where('idSong','=',$id)->get());

        $nbPlays = count(Listened::where('idListened','=',$id)->where('playlist','=',0)->get());

        $allPlaylists = Playlist::select('id','title')->where('user_id','=', Auth::id())->get();
        
        return view("page.song", ["song" => $song, "artist" => $uploaderName, "comments" => $comments, "nbComments" => $nbComments, "playlist" => false, "allPlaylists" => $allPlaylists, "nbLikes" => $nbLikes, "nbPlays" => $nbPlays]);
    }

    public function playlistId($id) { 
        $playlist = Playlist::findOrFail($id);
        $uploaderName = User::select('name')->where('id', '=', $playlist->user_id)->get();

        $playlistContent = [];
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

    public function deleteComment($id) {
        $remover = Auth::id();
        $post_author = Comment::where('id','=',$id)->first();

        if ($post_author->idWriter == $remover) {
            Comment::find($id)->delete();
        }

        return back();
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

    public function render($id, $file) {
        $song = Song::find($id);
        $file = ".".$song->url;
        $mime_type = "audio/mp3";
        $fileContents = File::get($file);

        return Response::make($fileContents, 200)
            ->header('Accept-Ranges', 'bytes')
            ->header('Content-Type', $mime_type)
            ->header('Content-Length', filesize($file))
            ->header('vary', 'Accept-Encoding');
    }
        
    public function addToPlaylist($idPlaylist, $idSong) {

        $tmp = PlaylistSong::where('idPlaylist','=',$idPlaylist)->where('idSong','=',$idSong)->get();

        if (count($tmp) == 0) {
            $playlistSong = new PlaylistSong();
            $playlistSong->idPlaylist = $idPlaylist;
            $playlistSong->idSong = $idSong;
            $playlistSong->save();
        }

        //avertissement doublon
        return redirect("/playlist/$idPlaylist");
    }

    // ignorer doublon
    public function ForceToPlaylist($idPlaylist, $idSong) {

        $playlistSong = new PlaylistSong();
        $playlistSong->idPlaylist = $idPlaylist;
        $playlistSong->idSong = $idSong;
        $playlistSong->save();

        return redirect("/playlist/$idPlaylist");
    }

    public function refreshInfo(Request $request) {

        if (isset($request->email) && (Auth::user()->email != $request->email)) {
            $request->validate([
                'email' => 'required|email'
            ]);

            Auth::user()->email = $request->input('email');
            Auth::user()->save();
        }

        if (isset($request->birthday) && (Auth::user()->birthday != $request->birthday)) {
            $request->validate([
                'birthday' => 'required|date'
            ]);

            Auth::user()->birthday = $request->input('birthday');
            Auth::user()->save();
        }

        if (isset($request->pwd) && isset($request->pwd_confirmation)) {
            $request->validate([
                'pwd' => 'required|confirmed|min:8'
            ]);

            Auth::user()->password = Hash::make($request->input('pwd'));
            Auth::user()->save();
        }

        if (isset($request->avatar_file) && (Auth::user()->avatar_file != $request->avatar_file)) {
            
            $request->validate([
                'avatar_file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);

            $avatarName = Auth::user()->id.'_avatar'.time().'.'.request()->avatar_file->getClientOriginalExtension();
            $request->file('avatar_file')->storeAs('public',$avatarName);

            Auth::user()->avatar = "/storage/".$avatarName;
            Auth::user()->save();
        }

        return back();
    }

    public function refreshNetwork(Request $request) {
        $networks =  ['youtube', 'soundcloud', 'twitter', 'instagram'];

        foreach ($networks as $network) {
            if (isset($request->$network) && (Auth::user()->$network != $request->$network)) {
                $request->validate([
                    $network => 'required|url'
                ]);
    
                Auth::user()->$network = $request->input($network);
                Auth::user()->save();
            }
        }

        if (isset($request->description) && (Auth::user()->description != $request->description)) {
            $request->validate([
                "description" => 'required|max:255'
            ]);

            Auth::user()->description = $request->input('description');
            Auth::user()->save();
        }
        
        return back();
    }

    public function createPlaylist() {
        return view("page.createPlaylist");
    }

    public function TcreatePlaylist(Request $request) {
        $request->validate([
            'playlist_title' => "required|min:4|max:255",
            'avatar_file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $avatarName = Auth::user()->id.'_playlist'.$request->input('playlist_title').'.'.request()->avatar_file->getClientOriginalExtension();
        $request->file('avatar_file')->storeAs('public',$avatarName);

        $playlist = new Playlist();
        $playlist->title = $request->input('playlist_title');
        $playlist->img = "/storage/".$avatarName;
        $playlist->user_id = Auth::id();

        $playlist->save();

        return redirect("/playlist/" . $playlist->id);
    }

    public function modifImage($type, $id) {
        if ($type == "playlist") {
            $changing = Playlist::where('id','=',$id)->where('user_id','=',Auth::id())->get()->first();
            if ($changing == "") {
                return view('errors/404');
            }
            return view('page.modifImg', ["changing" => $changing]);
        }
        
        else if ($type == "song") {
            $changing = Song::where('id','=',$id)->where('user_id','=',Auth::id())->get()->first();
            if ($changing == "") {
                return view('errors/404');
            }
            return view('page.modifImg', ["changing" => $changing]);
        }
        
        else {
            return view('errors/404');
        }
    }

    public function TmodifImage(Request $request, $type, $id) {
        if ($type == "song") {
            $song = Song::where('id','=',$id)->get()->first();
        } else if ($type == "playlist") {
            $playlist = Playlist::where('id','=',$id)->get()->first();
        }

        $request->validate([
            'avatar_file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if ($type == "song") {
            $avatarName = Auth::user()->id.'_song'.$song->title . time().'.'.request()->avatar_file->getClientOriginalExtension();
            $request->file('avatar_file')->storeAs('public',$avatarName);
            $song->img = "/storage/".$avatarName;
            $song->save();
        }
        
        else if ($type == "playlist") {
            $avatarName = Auth::user()->id.'_playlist'.$playlist->title . time().'.'.request()->avatar_file->getClientOriginalExtension();
            $request->file('avatar_file')->storeAs('public',$avatarName);
            $playlist->img = "/storage/".$avatarName;
            $playlist->save();
        }

        return back();
    }
}
