<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class MainController extends Controller
{

    public function main() {
        return view("page.main");
    }

    public function upload() {
        return view("page.upload");
    }

    public function song() {
        return view("page.song");
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
