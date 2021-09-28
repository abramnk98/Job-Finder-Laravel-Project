<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Career;
use App\Models\Location;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->has('title_or_company')) {

            $request->validate([
               "title_or_company" => "required",
               "category" => "required",
            ]);

            $jobs = Job::with('user.employeeProfile', 'career', 'location');

            if(!empty($request->city_or_region)) {

                $jobs = $jobs->whereHas('location', function ($query) use ($request) {
                    $query->where('city', 'like', '%'.$request->city_or_region.'%');
                    $query->orWhere('region', 'like', '%'.$request->city_or_region.'%');
                });
            }

            $jobs = $jobs->where(function ($query) use ($request) {
                    $query->where('title', 'like', '%'.$request->title_or_company.'%')
                        ->where('career_id', $request->category);
                })
                ->orWhereHas('user.employeeProfile', function ($query) use ($request) {
                    $query->where('company_name', 'like', '%'.$request->title_or_company.'%')
                        ->where('career_id', $request->category);
                });
//                ->toSql();

            if(!empty($request->city_or_region)) {

                $jobs = $jobs->whereHas('location', function ($query) use ($request) {
                    $query->where('city', 'like', '%'.$request->city_or_region.'%');
                    $query->orWhere('region', 'like', '%'.$request->city_or_region.'%');
                });
//                ->toSql();

            }

            $jobs = $jobs->get();

            if($request->has('jobs_page')) {

                return response()->json($jobs);
            }

        } else {

            $jobs = Job::with('user', 'career', 'location');

            if ($request->has('category') && !filter_var($request->category, FILTER_VALIDATE_INT)) {

                return abort(404);
            } elseif ($request->has('category') && filter_var($request->category, FILTER_VALIDATE_INT)) {

                $jobs = $jobs->where('career_id', $request->category);
            } else {

                $jobs = $jobs->orderByDesc('created_at');
            }

            $jobs = $jobs->get();

        }

        return view('user.jobs.index', ['jobs' => $jobs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $careers = Career::all();

        return view('user.jobs.new_job', ['careers' => $careers]);
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
            "job_title" => "required|min:4|max:150",
            "description" => "required|min:10",
            "career" => "required|integer|exists:careers,id",
            "job_type" => "required|in:Freelance,Full Time, Part Time",
            "image" => "image|mimes:jpeg,png,jpg,gif|max:1024",
            "street" => "required",
            "building" => "required|integer",
            "country" => "required|max:30",
            "city" => "required|max:30",
            "region" => "required|max:30",
        ]);

        $image_name = null;

        if ($image = $request->file('image')) {

            $image_name = date('YmdHis') .'.' . $image->getClientOriginalExtension();

            $full_path = 'assets/images/job/';

            $image->move($full_path, $image_name);
        }


        $location = Location::create([
            "country" => $request->input('country'),
            "city" => $request->input('city'),
            "region" => $request->input('region'),
            "building" => $request->input('building'),
            "street" => $request->input('street'),
        ]);

        $job = Job::create([
            "title" => $request->input('job_title'),
            "description" => $request->input('description'),
            "location_id" => $location->id,
            "min_salary" => $request->input('min_salary'),
            "max_salary" => $request->input('max_salary'),
            "type" => $request->input('job_type'),
            "user_id" => Auth::user()->id,
            "career_id" => $request->input('career'),
            "image" => $image_name,
        ]);

        return redirect()->route('employee.posts')->with('success', 'Created Job Success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function show(Job $job)
    {
        if (Auth::check() && auth()->user()->type == 'candidate'){

            $current_candidate_request = $job->candidates()
                ->wherePivot('job_id', $job->id)
                ->wherePivot('candidate_id', Auth::user()->candidateProfile->id)
                ->first();

            return view('user.jobs.job_single', ['job' => $job, 'current_candidate_request' => $current_candidate_request]);
        }

        return view('user.jobs.job_single', ['job' => $job]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function edit(Job $job)
    {

        $careers = Career::all();

        return view('user.jobs.edit', [
            'careers' => $careers,
            'job' => $job,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Job $job)
    {

        $request->validate([
            "job_title" => "required|min:4|max:150",
            "description" => "required|min:10",
            "career" => "required|integer|exists:careers,id",
            "job_type" => "required|in:Freelance,Full Time, Part Time",
            "image" => "image|mimes:jpeg,png,jpg,gif|max:1024",
            "street" => "required",
            "building" => "required|integer",
            "country" => "required|max:30",
            "city" => "required|max:30",
            "region" => "required|max:30",
        ]);

        $job->update([
            "title" => $request->input('job_title'),
            "description" => $request->input('description'),
            "min_salary" => $request->input('min_salary'),
            "max_salary" => $request->input('max_salary'),
            "type" => $request->input('job_type'),
            "career_id" => $request->input('career'),
        ]);

        if($image = $request->file('image')) {

            $image_name = date('YmdHis') . '.' . $image->getClientOriginalExtension();

            $fullPath = 'assets/images/job/';

            $image->move($fullPath, $image_name);

            $job->update([
                "image" => $image_name,
            ]);
        }




        Location::where('id', $job->location_id)
            ->update([
                "country" => $request->input('country'),
                "city" => $request->input('city'),
                "region" => $request->input('region'),
                "building" => $request->input('building'),
                "street" => $request->input('street'),
            ]);

        return redirect()->route('employee.posts')->with('success', 'Created Job Success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function destroy(Job $job)
    {
        //
    }

    public function jobRequest(Request $request) {

        if (!Auth::check()) {

            return redirect()->route('login');
        }

        $job = Job::find($request->id);
        $job->candidates()->attach(Auth::user()->candidateProfile->id, ['status' => 'pending', 'employee_id' => $job->user->id]);

        return redirect(url()->previous());
    }

    public function jobCancelRequest(Request $request)
    {

        Job::findOrFail($request->id)->candidates()->detach();

        return redirect(url()->previous());
    }
}
