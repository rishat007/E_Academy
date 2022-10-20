<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCardInfoRequest;
use App\Http\Requests\UserCardInfoUpdateRequest;
use App\Http\Resources\UserCardInfoResource;
use App\Models\UserCardInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class UserCardInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('Access User Card Info');

        return Cache::rememberForever('user_card_infos', function () {
            $user_card_info = UserCardInfo::get();
            return UserCardInfoResource::collection($user_card_info);
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
    public function store(UserCardInfoRequest $request)
    {
        try {
            DB::beginTransaction();
            UserCardInfo::create($request->safe()->all());
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
    public function update(UserCardInfoUpdateRequest $request, UserCardInfo $user_card_info)
    {
        try {
            DB::beginTransaction();
            $user_card_info->update($request->safe()->all());
            Cache::forget('user_card_infos');
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
    public function destroy(UserCardInfo $user_card_info)
    {
        try {
            DB::beginTransaction();
            $user_card_info->delete();
            Cache::forget('user_card_infos');
            DB::commit();
            return response()->noContent();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
}
