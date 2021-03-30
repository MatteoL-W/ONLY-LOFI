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

class SongPlaylistController extends Controller
{
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

        $newsong = Song::where('title','=',$song->title)->get()->first();
        $songid = $newsong->id;

        /*return view("page.song", ["song" => $songid]);*/
        return redirect("/song/" . $song->id)->with('toastr', ["status"=>"success", "message" => "Music successfully uploaded"]);;
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
}
