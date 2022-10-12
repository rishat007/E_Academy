<?php

namespace App\Http\Controllers;

use App\Http\Resources\ChapterWiseMcqQuestionResource;
use App\Models\Chapter;
use App\Models\Subject;
use Illuminate\Http\Request;

class ChapterWiseMcqQuestionController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Chapter $chapter)
    {
        $chapter->load('mcq_questions', 'mcq_questions.options');

        return new ChapterWiseMcqQuestionResource($chapter);
    }
}
