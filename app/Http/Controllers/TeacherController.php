<?php

namespace App\Http\Controllers;

use App\Http\Requests\TeacherStoreRequest;
use App\Events\TeacherRegistered;
use App\Http\Requests\TeacherUpdateRequest;
use App\Http\Resources\TeacherResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
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
            'filter' => ['nullable', 'string'],
        ]);
        $this->authorize('Access Teacher');

        $teacher = User::query()
            ->where('user_type', User::USER_TYPE_TEACHER)
            ->paginate($request->length);
        return TeacherResource::collection($teacher);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TeacherStoreRequest $request)
    {
        try {
            DB::beginTransaction();
            $user = User::create([
                'name' => $request->name,
                'phone_no' => $request->phone_no,
                'password' => Hash::make($request->password),
                'user_type' => User::USER_TYPE_TEACHER
            ]);
            $user->assignRole(User::USER_ROLE_TEACHER);

            event(new TeacherRegistered($user));
            
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
    public function update(TeacherUpdateRequest $request, User $teacher)
    {
        try {
            DB::beginTransaction();
            $teacher->update($request->safe()->all());
            
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
    public function destroy(User $teacher)
    {
        if($teacher->assignClass()->count()){
            return response()->json([
                'message' => __('The teacher has assigned class')
            ], 422);
        }
        try {
            DB::beginTransaction();
            $teacher->delete();
            
            DB::commit();
            return response()->noContent();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
}
