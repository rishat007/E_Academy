<?php

namespace Database\Seeders;

use App\Models\Role;
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

        $adminRole = Role::firstOrCreate(["name"=>"Admin", "guard_name"=>"web"]);
        $teacherRole = Role::firstOrCreate(["name"=>"Teacher", "guard_name"=>"web"]);
        $studentRole = Role::firstOrCreate(["name"=>"Student", "guard_name"=>"web"]);
        $freeStudentRole = Role::firstOrCreate(["name"=>"Free Student", "guard_name"=>"web"]);


        Artisan::call("cache:clear");
    }
}
