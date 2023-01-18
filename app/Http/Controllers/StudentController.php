<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class StudentController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $this->authorize('Access Students');

        return Cache::rememberForever('students', function () {
            $students = User::where('user_type', User::USER_TYPE_STUDENT)->get();
           return StudentsResource::collection($students);
        });
    }
}
