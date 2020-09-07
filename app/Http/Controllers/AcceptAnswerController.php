<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Answer;

class AcceptAnswerController extends Controller
{
    public function __invoke(Answer $answer)
    {
        $this->authorize('accept', $answer);
        $answer->question->best_answer_id=$answer->id;
        $answer->question->save();
        // $answer->question->acceptBestAnswer();
        return back();
    }
}
