<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GroupController extends Controller
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
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = \Auth::user();
        $groups = '';
        if ($user->is_admin) {
            $groups = \App\Group::all();
        }
        else {
            $groups = $user->groups_created()->get();
        }

        foreach ($groups as $group) {
            $group->creator_name = $group->creator()->get()[0]->name;
            $group->number_of_members = $group->members()->count();
            $group->activity_name = $group->activity()->get()[0]->name;
        }

        $settings = \App\SiteSettings::first();

        $my_joined_groups = [];
        foreach (\Auth::user()->groups_joined()->get() as $my_group) {
            array_push($my_joined_groups, $my_group->id);
        }

        return view('groups.index', compact('groups', 'settings', 'my_joined_groups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $settings = \App\SiteSettings::first();

        if ( $settings->users_can_create_groups || \Auth::user()->is_admin ) {

            $settings = \App\SiteSettings::first();
            $activities = \App\Activity::orderBy('name')->get();
            return view('groups.create', compact('activities', 'settings'));

        }

        return redirect()->route('home');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $settings = \App\SiteSettings::first();

        if ( $settings->users_can_create_groups || \Auth::user()->is_admin ) {

            $settings = \App\SiteSettings::first();
            $min = $settings->min_group_members;
            $max = $settings->max_group_members;

            $validatedData = $request->validate([
                'groupName' => 'required|unique:groups,name',
                'groupDescription' => 'required',
                'activityId' => 'required|exists:activities,id',
                'maxMembers' => 'required|integer|between:' . $settings->min_group_members . ',' . $settings->max_group_members
            ]);

            $input = $request->input();
            $group = new \App\Group;
            $group->name = $input['groupName'];
            $group->description = $input['groupDescription'];
            $group->creator_id = \Auth::user()->id;
            $group->activity_id = $input['activityId'];
            $group->max_members = $input['maxMembers'];
            $group->is_private = (array_key_exists('isPrivate', $input)) ? '1' : '0';
            $group->is_virtual = (array_key_exists('isVirtual', $input)) ? '1' : '0';
            $group->is_accepting_members = (array_key_exists('isAcceptingMembers', $input)) ? '1' : '0';
            $group->invitation_key = \Uuid::generate();
            $group->save();
            $request->session()->flash('status', 'Group created!');
            return redirect()->route('groups.index');

        }

        return redirect()->route('home');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return "I should show a record now (not for editing)!";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $settings = \App\SiteSettings::first();
        $group = \App\Group::find($id);

        if ( old('_token') ) {
            $group->name = old('groupName');
            $group->description = old('groupDescription');
            $group->activity_id = old('activityId');
            $group->max_members = old('maxMembers');
            $group->is_private = old('isPrivate') ? '1' : '0';
            $group->is_virtual = old('isVirtual') ? '1' : '0';
            $group->is_accepting_members = (old('isAcceptingMembers')) ? '1' : '0';
        }

        $activities = \App\Activity::orderBy('name')->get();
        return view('groups.edit', compact('group', 'activities', 'settings'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $settings = \App\SiteSettings::first();

        $validatedData = $request->validate([
            'groupName' => 'required|unique:groups,name,' . $id,
            'groupDescription' => 'required',
            'activityId' => 'required|exists:activities,id',
            'maxMembers' => 'required|integer|between:' . $settings->min_group_members . ',' . $settings->max_group_members
        ]);

        $input = $request->input();
        $group = \App\Group::find($id);
        $group->name = $input['groupName'];
        $group->description = $input['groupDescription'];
        $group->activity_id = $input['activityId'];
        $group->max_members = $input['maxMembers'];
        $group->is_private = (array_key_exists('isPrivate', $input)) ? '1' : '0';
        $group->is_virtual = (array_key_exists('isVirtual', $input)) ? '1' : '0';
        $group->is_accepting_members = (array_key_exists('isAcceptingMembers', $input)) ? '1' : '0';
        $group->save();
        $request->session()->flash('status', 'Group updated!');
        return redirect()->route('groups.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $group = \App\Group::find($id);
        if (\Auth::user()->is_admin || $group->creator_id == \Auth::user()->id) {

            // Delete all memberships in this group


            // Delete the group
            $group->delete();

            // Let the user know the group was deleted
            $request->session()->flash('status', 'Group deleted!');
            return redirect()->route('groups.index');
        }
        else {
            $request->session()->flash('status', 'You don\'t have permission to delete this group.');
            return redirect()->route('groups.index');            
        }

    }
}
