<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleStoreRequest;
use App\Http\Requests\RoleUpdateRequest;
use App\Http\Resources\RoleResource;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use JustSteveKing\StatusCode\Http;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('Access Student Class');

        return Cache::rememberForever('roles', function () {
            $roles = Role::get();
            return RoleResource::collection($roles);
        });
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleStoreRequest $request)
    {
        //store database
        try {
            DB::beginTransaction();
            $role = Role::create($request->safe()->all());
            $role->givePermissionTo($request->permissions);
            Cache::forget('roles');
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
    public function show(Role $role)
    {
        $this->authorize('Access Student Class');

        $role->load('permissions');

        return new RoleResource($role);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleUpdateRequest $request, Role $role)
    {
        //update database
        try {
            if(!$role->created_by){
                return response()->json(['message'=>'Role is not editable'], Http::NOT_ACCEPTABLE);
            }
            DB::beginTransaction();
            $role->update($request->safe()->all());
            $role->syncPermissions($request->permissions);
            Cache::forget('roles');
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
    public function destroy(Role $role)
    {
        $this->authorize('Delete Student Class');
         //delete the specified resource from database
         try {
            if(!$role->created_by){
                return response()->json(['message'=>'Role is not deleteable'], Http::NOT_ACCEPTABLE);
            }
            DB::beginTransaction();
            $role->syncPermissions([]);
            $role->delete();
            Cache::forget('roles');
            DB::commit();
            return response()->noContent();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
}
