<?php

namespace App\Http\Controllers;

use App\Models\Song;
use App\Models\Playlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangeController extends Controller
{
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
            $request->file('avatar_file')->storeAs('',$avatarName);

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









    public function changeLike($id) {
        Auth::user()->ILikeThem()->toggle($id);
        return back();
    }






    public function delete($type, $id) {

        if ($type == "playlist") {

            $changing = Playlist::where('id','=',$id)->where('user_id','=',Auth::id())->get()->first();
            if ($changing == "") {
                return view('errors/404');
            }

            if (Auth::id() == $changing->user_id) {
                $changing->delete();
            }
        }
        
        else if ($type == "song") {

            $changing = Song::where('id','=',$id)->where('user_id','=',Auth::id())->get()->first();
            if ($changing == "") {
                return view('errors/404');
            }
            
            if (Auth::id() == $changing->user_id) {
                $changing->delete();
            }

        }
        
        else {
            return view('errors/404');
        }

        return redirect("/user/" . Auth::id());

    }

}
