<?php

namespace App\Http\Controllers;

use App\Models\Song;
use App\Models\User;
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
        $songs = Song::all();
        return view("page.song", ["songs" => $songs]);
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

    public function user() {
        return view("page.user");
    }

    public function userId($id) {
        /*$artist = Artist::findOrFail($id);
        $oeuvres = Oeuvre::all()->where('idArtist', '=', $id);
        return view('page/artiste', ["artist" => $artist, "oeuvres" => $oeuvres]);*/
        $user = User::findOrFail($id);
        $social = ['youtube', 'soundcloud', 'twitter', 'instagram'];
        return view("page.user", ["user" => $user, "social" => $social]);
    }
}
