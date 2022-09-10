<?php

namespace App\Http\Controllers;

use App\Http\Resources\PermissionListResource;
use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PermissionListController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        return Cache::rememberForever('permission_list', function () {
            $modules = Module::with(["permission"=>function($query){
                return $query->select('name', 'module_id');
            }])
            ->isActive()
            ->select('id', 'name')
            ->oldest()
            ->get();
            return PermissionListResource::collection($modules);
        });

    }
}
