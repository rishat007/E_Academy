<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\Http\Requests\StudentClassRequest;
use App\Http\Requests\StudentClassStoreRequest;
use App\Http\Requests\StudentClassUpdateRequest;
use App\Http\Resources\StudentClassResource;
use App\Models\StudentClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use JustSteveKing\StatusCode\Http;

class StudentClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('Access Student Class');

        return Cache::rememberForever('student_classes', function () {
            $studentclasses = StudentClass::get();

           return StudentClassResource::collection($studentclasses);
        });
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StudentClassStoreRequest $request)
    {
        //
    try {
        DB::beginTransaction();
        $studentClass = new StudentClass();

        $studentClass->name=$request->name;
        $studentClass->status=$request->status;

        $studentClass->save();
        Cache::forget('student_classes');
        DB::commit();
        return response()->noContent();
    } catch (\Throwable $th) {
        DB::rollBack();
        throw $th;
    }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StudentClassUpdateRequest $request, StudentClass $studentClass)
    {
        //
        try {
            DB::beginTransaction();
            $studentClass->update($request->safe()->all());
            Cache::forget('student_classes');
            DB::commit();
            return response()->noContent();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(StudentClass $studentClass)
    {
        //
        try {
            DB::beginTransaction();
            $studentClass->delete();
            Cache::forget('student_classes');
            DB::commit();
            return response()->noContent();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
}
