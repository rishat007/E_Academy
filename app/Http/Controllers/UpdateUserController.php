<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class UpdateUserController extends Controller
{
    public function update(UserUpdateRequest $request, User $user)
    {
        //
        try {
            DB::beginTransaction();
            $user->update($request->safe()->all());
            Cache::forget('users');
            DB::commit();
            return response()->noContent();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
}
