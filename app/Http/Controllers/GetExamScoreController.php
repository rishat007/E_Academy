<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exam;
use App\Http\Resources\ExamScoreResource;

class GetExamScoreController extends Controller
{
    public function __invoke(Request $request, Exam $exam)
    {
        $exam->loadCount([
            'examAnswer'=>function($query){
                return $query->where('score', 1);
            },
            'examAnswer as participate' 
        ]);
        $exam->load(['chapter','chapter.subject', ]);

        // if($request->has('question')){
        //     $exam->load(['chapter','chapter.subject', ]);
        // }

        return new ExamScoreResource($exam);
    }
}
