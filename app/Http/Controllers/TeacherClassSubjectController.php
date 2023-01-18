<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AssignTeacherRequest;
use App\Http\Resources\TeacherClassSubjectResource;
use App\Models\TeacherClassSubject;
use App\Events\TeachAssign;
use App\Events\DeleteTeachAssign;
use App\Events\UpdateTeachAssign;
use DB;

class TeacherClassSubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->merge([
            'length' => $request->length ?: 15,
        ]);
        $request->validate([
            'length' => ['required', 'integer', 'max:100'],
        ]);
        $this->authorize('Access Teacher Assign');

        $teacher = TeacherClassSubject::query()
            ->with(['teacher', 'subject', 'class'])
            ->paginate($request->length);
        return TeacherClassSubjectResource::collection($teacher);
    }

    public function store(AssignTeacherRequest $request)
    {
        try {
            DB::beginTransaction();
            
            $teacherAssign = TeacherClassSubject::create($request->safe()->all());

            event(new TeachAssign($teacherAssign));
            
            DB::commit();
            return response()->noContent();

        } catch (\Throwable $th) {
            DB::rollback();
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AssignTeacherRequest $request,$id)
    {
        $teacherClassSubject = TeacherClassSubject::findOrfail($id);
        try {
            DB::beginTransaction();
            
            $teacherClassSubject->update($request->safe()->all());

            event(new UpdateTeachAssign($teacherClassSubject));
            
            DB::commit();
            return response()->noContent();

        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('Access Teacher Assign');
        $teacherClassSubject = TeacherClassSubject::findOrfail($id);
        try {
            DB::beginTransaction();
            
            $teacherClassSubject->delete();

            event(new DeleteTeachAssign($teacherClassSubject));
            
            DB::commit();
            return response()->noContent();

        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
    }
}
