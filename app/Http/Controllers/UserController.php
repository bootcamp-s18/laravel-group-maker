<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
	
	public function __construct()
    {
        $this->middleware('auth');
    }


    public function profile_edit() {

    	return view('users.profile');

    }

    public function profile_save(Request $request) {

        $input = $request->input();
        \Auth::user()->default_lat = array_key_exists('accepted_lat', $input) ? $input['accepted_lat'] : null;
        \Auth::user()->default_lon = array_key_exists('accepted_lon', $input) ? $input['accepted_lon'] : null;
        \Auth::user()->save();

        $request->session()->flash('status', 'Profile updated!');

        return redirect()->route('home');

    }
}
