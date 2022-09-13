<?php

use App\Http\Controllers\Common\ChapterController;
use App\Http\Controllers\Common\ClassWiseSubjectController;
use App\Http\Controllers\Common\StudentClassController;
use App\Http\Controllers\Common\SubjectController;
use App\Http\Controllers\PermissionListController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SubjectWiseChapterController;
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
    Route::get("class_wise_subject/{studentClass}", ClassWiseSubjectController::class);
    Route::get("subject_wise_chapter/{subject}", SubjectWiseChapterController::class);

});

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

require __DIR__.'/auth.php';
