<?php

namespace App\Http\Controllers;
use App\Http\Requests\AnswerCheckRequest;
use App\Http\Resources\ChapterWiseMcqQuestionResource;
use App\Models\McqQuestion;
use Illuminate\Http\Request;

class AnswerCheckController extends Controller
{
    public function __invoke(AnswerCheckRequest $request, McqQuestion $mcq_question)
    {
       //
       if($request->given_answer=== $mcq_question->answer){
        return response()->json([
            'status' => true
        ]);
       }
       else{
        return response()->json([
            'status' => false
        ]);
       }
    }
}
