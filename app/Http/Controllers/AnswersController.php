<?php

namespace App\Http\Controllers;

use App\Answer;
use App\question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnswersController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Question $question ,Request $request)
    {
        $request->validate([
            'body'=> 'required'
        ]);
        //dd(Auth::id());
        $question->answer()->create(['body'=> $request->body, 'user_id'=> Auth::id()]);
        return back()->with('success', 'Your answer has been submmited successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question, Answer $answer)
    {
        $this->authorize('update', $answer);

        return view('answers.edit', compact('question', 'answer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question, Answer $answer)
    {
        $this->authorize('update', $answer);

        // $request->validate([
        //    'body'=>'required'
        // ]);
        // $answer->update($request->all());

        // $answer->update([$request->body]);

        $answer->update($request->validate([
            'body'=>'required'
        ]));

        return redirect()->route('questions.show', $question->slug)->with('success', "Your answer has been updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(question $question)
    {
        //
    }
}