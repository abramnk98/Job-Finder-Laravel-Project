<?php

namespace App\Http\Controllers;

use App\Models\CandidateProfile;
use App\Models\EmployeeProfile;
use App\Models\Job;
use App\Models\JobCandidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class EmployeeProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $job_posts = Job::with('user')
            ->where('user_id', Auth::user()->id)
            ->limit(5)
            ->get();

        $job_requests = JobCandidate::with('candidate', 'job')
            ->where('employee_id', Auth::user()->id)
            ->orderByDesc('created_at')
            ->limit(5)
            ->get();

        return view('user.employees.profile', ['job_posts' => $job_posts, 'job_requests' => $job_requests]);
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


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EmployeeProfile  $employeeProfile
     * @return \Illuminate\Http\Response
     */
    public function show(EmployeeProfile $employeeProfile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EmployeeProfile  $employeeProfile
     * @return \Illuminate\Http\Response
     */
    public function edit(EmployeeProfile $profile)
    {
        if ($profile->id !== Auth::user()->employeeProfile->id) {

            return abort(404);
        }

        return view('user.employees.employee_edit', ['employeeProfile' => $profile]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EmployeeProfile  $employeeProfile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EmployeeProfile $profile)
    {

        if ($profile->id !== Auth::user()->employeeProfile->id) {

            return abort(404);
        }

        $request->validate([
            'company_name' => "required",
            'first_name' => "required",
            'last_name' => "required",
            "phone" => ["required","size:11", Rule::unique('employee_profiles')->ignore($profile)],
            "logo" => "image|mimes:jpeg,png,jpg|max:1024",
        ]);

        $profile->update([
            "first_name" => $request->first_name,
            "last_name" => $request->last_name,
            "company_name" => $request->company_name,
            "phone" => $request->phone,
        ]);

        if($image = $request->file('logo')) {

            $image_name = date('YmdHis') .'.' . $image->getClientOriginalExtension();

            $full_path = 'assets/images/company_logo/';

            $image->move($full_path, $image_name);

            $profile->update([
                'logo' => $image_name
            ]);
        }


        $user = Auth::user();

        $user->update([
            'name' => $request->first_name . ' ' . $request->last_name
        ]);

        return redirect()->route('employee.profile.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EmployeeProfile  $employeeProfile
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmployeeProfile $employeeProfile)
    {
        //
    }

    public function indexPost()
    {
        $jobs = Job::where('user_id', '=', Auth::user()->id)
            ->with('user', 'career', 'location')
            ->get();

        return view('user.employees.posts', ['jobs' => $jobs]);
    }

    public function browseCandidates(Request $request)
    {

        if($request->has('category')) {

            $request->validate([
                "category" => "required",
            ]);

            $candidates = CandidateProfile::all();

            foreach($candidates as $candidate) {

                $candidate_careers = $candidate->careers;

                $candidate_careers = array_reverse(explode(',', $candidate_careers));

                unset($candidate_careers[0]);

                $careers[] = ['candidate_id' => $candidate->id, 'careers_ids' => $candidate_careers];
            }

            foreach($careers as $career) {

                if(array_search($request->category, $career['careers_ids'])) {
                    $candidates_ids[] = $career['candidate_id'];
                }
            }

            $candidates_ids = array_unique($candidates_ids);

            $candidates = CandidateProfile::with('user', 'location')->whereIn('id', $candidates_ids);

            if(!empty($request->city_or_region)) {

                $candidates = $candidates->whereHas('location',function ($query) use ($request) {
                    $query->where('city', 'like', '%'.$request->city_or_region.'%');
                    $query->orWhere('region', 'like', '%'.$request->city_or_region.'%');
                });
            }

            $candidates = $candidates->get();
        }


        if($request->has('ajax')) {

            return response()->json($candidates);
        } elseif(!$request->has('category')) {

            $candidates = CandidateProfile::with('user', 'location')->get();
        }

        return view('user.employees.browse_candidates',['candidates' => $candidates]);
    }

    public function jobRequestIndex() {

        $job_requests = JobCandidate::with('candidate', 'job')
            ->where('employee_id', Auth::user()->id)
            ->orderByDesc('created_at')
            ->get();

        return view('user.employees.job_requests', ['job_requests' => $job_requests]);
    }

    public function requestAction(Request $request, $job_id, $status) {
//dd($request->candidate_id.' '.$job_id.' '.$status);
        Job::find($job_id)->candidates()->sync([$request->candidate_id => ['status' => $status]], false);

        return redirect(url()->previous());
    }

}
