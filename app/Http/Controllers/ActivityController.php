<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ActivityController extends Controller
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
        if (\Auth::user()->is_admin) {

            $showForm = false;

            // TODO: It would be really cool if this worked.
            // if ($errors->any()) {
            //     $showForm = true;
            // }

            $activities = \App\Activity::orderBy('name')->get();

            foreach ($activities as $activity) {
                $activity->numberOfGroups = $activity->groups()->count();
                $activity->numberOfParticipants = $activity->participants();
            }

            return view('activities.index', compact('activities', 'showForm'));
        }

        return redirect()->route('home');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect('/activities');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if (\Auth::user()->is_admin) {

            $validatedData = $request->validate([
                'activityName' => 'required|unique:activities,name',
                'activityDescription' => 'required',
            ]);

            $activity = new \App\Activity;
            $activity->name = $request->input('activityName');
            $activity->description = $request->input('activityDescription');
            $activity->save();
            $request->session()->flash('status', 'Activity created!');
            return redirect()->route('activities.index');

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
        return redirect('/activities');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (\Auth::user()->is_admin) {

            $activity = \App\Activity::find($id);
            return view('activities.edit', compact('activity'));

        }

        return redirect()->route('home');

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

        if (\Auth::user()->is_admin) {

            $validatedData = $request->validate([
                'activityName' => 'required|unique:activities,name,' . $id,
                'activityDescription' => 'required',
            ]);

            $activity = \App\Activity::find($id);
            $activity->name = $request->input('activityName');
            $activity->description = $request->input('activityDescription');
            $activity->save();
            $request->session()->flash('status', 'Activity updated!');
            return redirect()->route('activities.index');
        
        }

        return redirect()->route('home');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {

        if (\Auth::user()->is_admin) {

            \App\Activity::destroy($id);
            $request->session()->flash('status', 'Activity deleted!');
            return redirect()->route('activities.index');

        }

        return redirect()->route('home');

    }
}
