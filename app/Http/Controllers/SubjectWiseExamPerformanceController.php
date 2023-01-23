<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exam;
use App\Models\Subject;
use App\Models\Chapter;
use App\Http\Resources\SubjectWiseExamPerformanceResource;

class SubjectWiseExamPerformanceController extends Controller
{
    public function __invoke(Request $request)
    {
        $student_id = auth()->id();

        $chapter_ids = Exam::query()
            ->where('student_id', $student_id)
            ->pluck('chapters_id');
        
        $subject_ids = Chapter::query()
            ->whereIn('id', $chapter_ids)
            ->pluck('subjects_id');

        $subject = Subject::query()
            ->with(['exams' => function($query) use ($student_id) {
                return $query->withCount(['examAnswer as score'=>function($query){
                    return $query->correct();
                }])
                ->withCount('examAnswer as participate')
                ->with('chapter:id,name')
                ->where('student_id', '=', $student_id);
            }])
            ->select(['id', 'uuid', 'name'])
            ->whereIn('id', $subject_ids)
            ->get();
        
        return SubjectWiseExamPerformanceResource::collection($subject);
    }
}
