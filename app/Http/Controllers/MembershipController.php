<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MembershipController extends Controller
{
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index() 
    {
    	$groups = \App\Group::where([
    		['is_accepting_members', '=', true],
    		['is_private', '=', false]
    	])->orderBy('name', 'asc')->get();

        foreach ($groups as $group) {
            $group->creator_name = $group->creator()->get()[0]->name;
            $group->number_of_members = $group->members()->count();
            $group->activity_name = $group->activity()->get()[0]->name;
        }

    	return view('memberships.index', compact('groups'));

    }

    public function join(Request $request, $group_id) {

    	$group = \App\Group::find($group_id);
    	$group->members()->syncWithoutDetaching([\Auth::user()->id]);

    	if ($group->members()->count >= $group->max_members) {
    		$group->is_accepting_members = false;
    		$group->save();
    	}

        $request->session()->flash('status', 'Group joined!');
        return redirect()->route('memberships');

    }




}
