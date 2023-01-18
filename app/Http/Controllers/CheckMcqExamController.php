<?php

namespace App\Http\Controllers;

use App\Http\Resources\CheckMcqExamResource;
use App\Models\Chapter;
use App\Models\Exam;
use App\Models\ExamAnswer;
use App\Models\McqQuestion;
use App\Models\QuizExam;
use Illuminate\Http\Request;

class CheckMcqExamController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Exam $exam)
    {
        $uuid = [];

        foreach ($request->question_answer as $key => $question_answer) {
            $uuid[] = $key;
        }

        $questions = McqQuestion::query()
            ->whereUuid($uuid)
            ->get();

        $toStore = [];
        $score = 0;
        foreach ($questions as $question) {
            $toStore[] = [
                "exam_id" =>  $exam->id,
                'question_id' => $question->id,
                'correct_answer' => $question->answer,
                'given_answer' => @$request->question_answer[$question->uuid],
                'score' => $question->answer == @$request->question_answer[$question->uuid] ? 1 : 0,
            ];
            if($question->answer == @$request->question_answer[$question->uuid]){
                $score++;
            }
        }

        ExamAnswer::insert($toStore);

        return response()->json([
            'score' => $score,
        ]);
    }
}
