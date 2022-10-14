<?php

namespace App\Http\Controllers;

use App\Http\Resources\StartExamResource;
use App\Models\Chapter;
use App\Models\QuizExam;
use Illuminate\Http\Request;

class StartExamController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $chapter = Chapter::whereUuid($request->chapters_id)->firstOrFail();

        $startExam = QuizExam::create([
            'student_id' => auth('sanctum')->id(),
            'chapters_id' => $chapter->id
        ]);
        return new StartExamResource($startExam);

    }
}
