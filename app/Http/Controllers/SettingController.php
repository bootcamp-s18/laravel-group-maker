<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index() {

    	if (\Auth::user()->is_admin) {
	    	$settings = \App\SiteSettings::first();
	    	if (!$settings) {
		    	$settings = new \App\SiteSettings;
	    	}
	    	return view('settings.index', compact('settings'));
	    }

    	return redirect()->route('home');

    }

    public function store(Request $request) {

        $validatedData = $request->validate([
            'websiteName' => 'required',
            'websiteDescription' => 'required',
            'maxMembers' => 'required|min:0',
            'minMembers' => 'required|min:0'
        ]);

    	$settings = new \App\SiteSettings;
    	$settings->website_name = $request->input('websiteName');
    	$settings->website_description = $request->input('websiteDescription');
    	$settings->users_can_create_groups = $request->input('usersCanCreateGroups') ? 1 : 0;
    	$settings->max_group_members = $request->input('maxMembers');
    	$settings->min_group_members = $request->input('minMembers');
    	$settings->save();
        $request->session()->flash('status', 'Site settings updated!');
        return redirect()->route('home');
    }

    public function update(Request $request, $id) {

        $validatedData = $request->validate([
            'websiteName' => 'required',
            'websiteDescription' => 'required',
            'maxMembers' => 'required|min:0',
            'minMembers' => 'required|min:0'
        ]);

    	$settings = \App\SiteSettings::find($id);
    	$settings->website_name = $request->input('websiteName');
    	$settings->website_description = $request->input('websiteDescription');
    	$settings->users_can_create_groups = $request->input('usersCanCreateGroups') ? 1 : 0;
    	$settings->max_group_members = $request->input('maxMembers');
    	$settings->min_group_members = $request->input('minMembers');
    	$settings->save();
        $request->session()->flash('status', 'Site settings updated!');
        return redirect()->route('home');

    }

    public function not_configured() {

    	return view('settings.not_configured');

    }

}
