<?php

namespace App\Http\Controllers;

use App\Models\CandidateProfile;
use App\Models\Career;
use App\Models\Service;
use App\Models\Job;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index() {

        if(Auth::check() &&  Auth::user()->type === 'employee') {

            $jobs = Job::with('career')->where('user_id', Auth::user()->id)->get();

            $job_careers = [];

            foreach($jobs as $job) {

                $job_careers[] = $job->career->id;
            }

            $job_careers = array_unique($job_careers);

            $candidates = CandidateProfile::all();

            foreach($candidates as $candidate) {

                $candidate_careers = $candidate->careers;

                $candidate_careers = array_reverse(explode(',', $candidate_careers));

                unset($candidate_careers[0]);

                $careers[] = ['candidate_id' => $candidate->id, 'careers_ids' => $candidate_careers];
            }

            $candidates_ids = [];

            foreach($job_careers as $career_id) {

                foreach($careers as $career) {

                    if(array_search($career_id, $career['careers_ids'])) {
                        $candidates_ids[] = $career['candidate_id'];
                    }
                }
            }

            $candidates_ids = array_unique($candidates_ids);

            $recommended_candidates = CandidateProfile::with('user', 'location')->whereIn('id', $candidates_ids)->get();

            return view('user.home', ['recommended_candidates' => $recommended_candidates]);
        }

        if (Auth::check() &&  Auth::user()->type === 'candidate') {


            $candidate_careers = Auth::user()->candidateProfile->careers;

            $careers = array_reverse(explode(',', $candidate_careers));

            unset($careers[0]);


            $recommended_jobs = Job::with('user', 'career', 'location')
                ->whereIn('career_id', $careers)
                ->get();

            return view('user.home', ['recommended_jobs' => $recommended_jobs]);
        }

        $recent_jobs = Job::with('user', 'career', 'location')
            ->orderByDesc('created_at')
            ->limit(5)
            ->get();

        return view('user.home', ['recent_jobs' => $recent_jobs]);
    }

    public function careerIndex()
    {

        $careers = Career::with('jobs')->withCount('jobs')->get();

        return response()->json($careers);
    }

    public function serviceIndex()
    {
        $services = Service::where('status', 'on')->limit(4)->get();

        $services = $services->chunk(2);

        return response()->json($services);
    }
}
