<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $adminRole = Role::firstOrCreate(["name"=>User::USER_ROLE_ADMIN, "guard_name"=>"web"]);
        $teacherRole = Role::firstOrCreate(["name"=>User::USER_ROLE_TEACHER, "guard_name"=>"web"]);
        $studentRole = Role::firstOrCreate(["name"=>User::USER_TYPE_STUDENT, "guard_name"=>"web"]);
        $freeStudentRole = Role::firstOrCreate(["name"=>User::USER_ROLE_FREE_STUDENT, "guard_name"=>"web"]);


        Artisan::call("cache:clear");
    }
}
