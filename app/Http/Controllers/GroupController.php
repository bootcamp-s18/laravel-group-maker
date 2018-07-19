<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GroupController extends Controller
{
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

        return view('groups.index', compact('groups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $activities = \App\Activity::orderBy('name')->get();
        return view('groups.create', compact('activities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'groupName' => 'required|unique:groups,name',
            'groupDescription' => 'required',
            'activityId' => 'required|exists:activities,id',
            'maxMembers' => 'min:1|max:100'
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
        return "I should display an edit form now!";
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
        return "I should update a record now!";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return "I should delete a record now!";
    }
}