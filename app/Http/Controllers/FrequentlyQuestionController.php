<?php

namespace App\Http\Controllers;

use App\Models\FrequentlyQuestion;
use Illuminate\Http\Request;

class FrequentlyQuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $frequentlyQuestions = FrequentlyQuestion::all();

        return view('admin.frequently_questions.index', ['frequentlyQuestions' => $frequentlyQuestions]);
    }

    /*
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
     * @param  \App\Models\FrequentlyQuestion  $frequentlyQuestion
     * @return \Illuminate\Http\Response
     */
    public function show(FrequentlyQuestion $frequentlyQuestion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FrequentlyQuestion  $frequentlyQuestion
     * @return \Illuminate\Http\Response
     */
    public function edit(FrequentlyQuestion $frequentlyQuestion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FrequentlyQuestion  $frequentlyQuestion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FrequentlyQuestion $frequentlyQuestion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FrequentlyQuestion  $frequentlyQuestion
     * @return \Illuminate\Http\Response
     */
    public function destroy(FrequentlyQuestion $frequentlyQuestion)
    {
        //
    }

    public function indexAjax()
    {

        $frequentlyQuestions = FrequentlyQuestion::all();

        return response()->json($frequentlyQuestions);
    }
}
