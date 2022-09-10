<?php

use App\Http\Controllers\Common\StudentClassController;
use App\Http\Controllers\PermissionListController;
use App\Http\Controllers\RoleController;
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
    Route::post("student_class",[StudentClassController::class,"store"]);
    Route::get("permission_list", PermissionListController::class);
    Route::apiResource("role", RoleController::class);
});

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

require __DIR__.'/auth.php';
