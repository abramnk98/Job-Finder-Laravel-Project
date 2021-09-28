<?php

namespace App\Http\Controllers;

use App\Models\CandidateProfile;
use App\Models\Career;
use App\Models\User;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class CandidateProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $job_requests = CandidateProfile::findOrFail(Auth::user()->candidateProfile->id)
            ->jobs()
            ->with('user')
            ->orderByDesc('created_at')
            ->limit(5)
            ->get();

        return view('user.candidates.profile', ['job_requests' => $job_requests]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CandidateProfile  $candidateProfile
     * @return \Illuminate\Http\Response
     */
    public function show(CandidateProfile $candidateProfile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CandidateProfile  $candidateProfile
     * @return \Illuminate\Http\Response
     */
    public function edit(CandidateProfile $profile)
    {

        if ($profile->id !== Auth::user()->candidateProfile->id) {

            return abort(404);
        }

        $careers = Career::all();

        $candidate_careers = array_reverse(explode(',', $profile->careers));

        unset($candidate_careers[0]);

        return view('user.candidates.candidate_edit',
            [
            'candidate_profile' => $profile,
            'candidate_careers' => $candidate_careers,
            'careers' => $careers,
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CandidateProfile  $candidateProfile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CandidateProfile $profile)
    {

        if ($profile->id !== Auth::user()->candidateProfile->id) {

            return abort(404);
        }

        $request->validate([
            'first_name' => "required",
            'last_name' => "required",
            "phone" => ["required", "size:11", Rule::unique('candidate_profiles')->ignore($profile)],
            "photo" => "image|mimes:jpeg,png,jpg|max:1024",
            'career' => 'required',
            "street" => "required",
            "building" => "required|integer",
            "country" => "required|max:30",
            "city" => "required|max:30",
            "region" => "required|max:30",
        ]);

        $careers = "";

        foreach ($request->career as $id => $status) {

            $careers .= $id . ',';
        }

        $profile->update([
            "first_name" => $request->first_name,
            "last_name" => $request->last_name,
            "phone" => $request->phone,
            'careers' => $careers,
            "street" => $request->street,
            "building" => $request->building,
            "country" => $request->country,
            "city" => $request->city,
            "region" => $request->region,
        ]);

        if($image = $request->file('photo')) {

            $image_name = date('YmdHis') .'.' . $image->getClientOriginalExtension();

            $full_path = 'assets/images/candidate_photo/';

            $image->move($full_path, $image_name);

            $profile->update([
                'photo' => $image_name
            ]);
        }


        $user = Auth::user();

        $user->update([
            'name' => $request->first_name . ' ' . $request->last_name
        ]);

        return redirect()->route('candidate.profile.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CandidateProfile  $candidateProfile
     * @return \Illuminate\Http\Response
     */
    public function destroy(CandidateProfile $candidateProfile)
    {
        //
    }

    public function jobRequestIndex() {

        $job_requests = CandidateProfile::findOrFail(Auth::user()->candidateProfile->id)
            ->jobs()->with('user')->get();
//    dd($job_requests);
        return view('user.candidates.job_requests', ['job_requests' => $job_requests]);
    }
}
