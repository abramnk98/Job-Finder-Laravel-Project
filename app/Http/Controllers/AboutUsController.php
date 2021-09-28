<?php

namespace App\Http\Controllers;

use App\Models\FrequentlyQuestion;
use Illuminate\Http\Request;
use App\Models\Team;

class AboutUsController extends Controller
{
    public function index()
    {

        $team = Team::all();

        $frequently_questions = FrequentlyQuestion::limit(4)->get();

        return view('user.about-us', ['team' => $team, 'frequently_questions' => $frequently_questions]);
    }

}
