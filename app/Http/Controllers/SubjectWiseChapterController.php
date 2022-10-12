<?php

namespace App\Http\Controllers;

use App\Http\Resources\SubjectWiseChapterResource;
use App\Models\Chapter;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectWiseChapterController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Subject $subject)
    {
        $subject->load('chapters');
        return new SubjectWiseChapterResource($subject);
    }
}
