<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegistrationStoreRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(RegistrationStoreRequest $request)
    {

        try {
            DB::beginTransaction();
            $user = User::create([
                'name' => $request->name,
                'phone_no' => $request->phone_no,
                'password' => Hash::make($request->password),
            ]);
            $user->assignRole('Free Student');

            event(new Registered($user));

            Auth::login($user);

            $token = $request->user()->createToken("auth_token")->plainTextToken;
            DB::commit();
            return response()->json([
                "access_token"=>$token
            ],200);

        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
    }
}
