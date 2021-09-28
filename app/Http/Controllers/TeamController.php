<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $team = Team::all();

        return view('admin.team.index', ['team' => $team]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.team.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'job' => 'required',
            'photo' => 'required|image|mimes:jpg,png,jpeg|max:1024',
            'status' =>'required',
        ]);

        if ($image = $request->file('photo')) {

            $image_name = date('YmdHis') . '.' . $image->getClientOriginalExtension();

            $path = 'assets/images/team/';

            $image->move($path, $image_name);
        }
        Team::create([
            'name' => $request->name,
            'job' => $request->job,
            'photo' => $image_name,
            'status' =>$request->status,
        ]);

        return redirect()->route('admin.team.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function show(Team $team)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function edit(Team $team)
    {

        return view('admin.team.edit', ['member' => $team]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Team $team)
    {

        $request->validate([
            'name' => 'required',
            'job' => 'required',
            'photo' => 'image|mimes:jpg,png,jpeg|max:1024',
            'status' =>'required',
        ]);


        $team->update([
            'name' => $request->name,
            'job' => $request->job,
            'status' => $request->status,
        ]);

        if($image = $request->file('photo')) {

            $image_name = date('YmdHis') . '.' . $image->getClientOriginalExtension();

            $path = 'assets/images/team/';

            $image->move($path, $image_name);

            $team->update([
                'photo' => $image_name,
            ]);
        }

        return redirect()->route('admin.team.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function destroy(Team $team)
    {
        $team->delete();

        return redirect()->route('admin.team.index');
    }
}
