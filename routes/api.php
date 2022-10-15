<?php

use App\Http\Controllers\AnswerCheckController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ChapterWiseMcqQuestionController;
use App\Http\Controllers\CheckMcqExamController;
use App\Http\Controllers\Common\ChapterController;
use App\Http\Controllers\Common\ClassWiseSubjectController;
use App\Http\Controllers\Common\StudentClassController;
use App\Http\Controllers\Common\SubjectController;
use App\Http\Controllers\McqQuestionController;
use App\Http\Controllers\PermissionListController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StartExamController;
use App\Http\Controllers\SubjectWiseChapterController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\TeacherRegisterController;
use App\Http\Controllers\UserProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group(["middleware" => ["auth:sanctum"]], function(){
    Route::get("permission_list", PermissionListController::class);
    Route::apiResource("role", RoleController::class);
    Route::apiResource("student_classes", StudentClassController::class);
    Route::apiResource("subject", SubjectController::class);
    Route::apiResource("chapter", ChapterController::class);
    Route::apiResource("mcq_question", McqQuestionController::class);
    Route::apiResource("teacher", TeacherController::class);
    Route::post("stuff", [RegisteredUserController::class, 'store']);
    Route::get("class_wise_subject/{studentClass}", ClassWiseSubjectController::class);
    Route::get("subject_wise_chapter/{subject}", SubjectWiseChapterController::class);
    Route::get("chapter_wise_mcq_question/{chapter}", ChapterWiseMcqQuestionController::class);
    Route::get("answer_check/{mcq_question}",AnswerCheckController::class);
    Route::post("start_exam",StartExamController::class);
    Route::get("mcq_exam_check/{exam}",CheckMcqExamController::class);

});

Route::middleware(['auth:sanctum'])->get('/user', UserProfileController::class);

require __DIR__.'/auth.php';
