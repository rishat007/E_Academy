<?php

namespace Database\Seeders;

use App\Models\Module;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Model::unguard();

        $adminRole = Role::firstOrCreate(["name"=>"Admin", "guard_name"=>"web"]);
        $teacherRole = Role::firstOrCreate(["name"=>"Teacher", "guard_name"=>"web"]);
        $studentRole = Role::firstOrCreate(["name"=>"Student", "guard_name"=>"web"]);
        $freeStudentRole = Role::firstOrCreate(["name"=>"Free Student", "guard_name"=>"web"]);

        $studentClass = Module::firstOrCreate([
            "name"=>"Student Class",
            "status"=>1
        ]);

        Permission::firstOrCreate(["name"=>"Access Student Class","module_id"=>$studentClass->id]);
        Permission::firstOrCreate(["name"=>"Create Student Class","module_id"=>$studentClass->id]);
        Permission::firstOrCreate(["name"=>"Update Student Class","module_id"=>$studentClass->id]);
        Permission::firstOrCreate(["name"=>"Delete Student Class","module_id"=>$studentClass->id]);

        $permissionList= [
            "Access Student Class",
            "Create Student Class",
            "Update Student Class",
            "Delete Student Class",
        ];
        $adminRole->givePermissionTo($permissionList);

        $courseModule = Module::firstOrCreate([
            'name'=> 'Course',
            'status' => 1
        ]);
        $chapterModule = Module::firstOrCreate([
            'name'=> 'Chapter',
            'status' => 1
        ]);

        Artisan::call("cache:clear");
    }
}
