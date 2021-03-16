<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    public function inscription() {
        return view("auth.register");
    }

    public function main() {
        return view("page.main");
    }

    public function upload() {
        return view("page.upload");
    }

    public function song() {
        return view("page.song");
    }
}
