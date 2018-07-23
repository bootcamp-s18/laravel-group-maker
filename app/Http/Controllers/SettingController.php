<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index() {

    	return view('settings.index');

    }

    public function store(Request $request) {

    	return "Saving new settings...";

    }

    public function update(Request $request) {

    	return "Updating settings...";

    }

    public function not_configured() {

    	return view('settings.not_configured');

    }

}
