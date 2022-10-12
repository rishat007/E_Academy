<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\Http\Resources\ClassWiseSubjectResource;
use App\Models\StudentClass;
use Illuminate\Http\Request;

class ClassWiseSubjectController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(StudentClass $studentClass)
    {
        $studentClass->load('subjects');
        return new ClassWiseSubjectResource($studentClass);
    }
}
