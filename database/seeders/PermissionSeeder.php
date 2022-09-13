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

        $subject = Module::firstOrCreate([
            'name'=> 'Course',
            'status' => 1
        ]);

        Permission::firstOrCreate(["name"=>"Access Subject","module_id"=>$subject->id]);
        Permission::firstOrCreate(["name"=>"Access Class Wise Subject","module_id"=>$subject->id]);
        Permission::firstOrCreate(["name"=>"Create Subject","module_id"=>$subject->id]);
        Permission::firstOrCreate(["name"=>"Update Subject","module_id"=>$subject->id]);
        Permission::firstOrCreate(["name"=>"Delete Subject","module_id"=>$subject->id]);

        $permissionList= [
            "Access Subject",
            "Access Class Wise Subject",
            "Create Subject",
            "Update Subject",
            "Delete Subject",
        ];
        $adminRole->givePermissionTo($permissionList);
        $teacherRole->givePermissionTo($permissionList);

        $chapter = Module::firstOrCreate([
            'name'=> 'Chapter',
            'status' => 1
        ]);

        Permission::firstOrCreate(["name"=>"Access Chapter","module_id"=>$chapter->id]);
        Permission::firstOrCreate(["name"=>"Access Subject Wise Chapter","module_id"=>$chapter->id]);
        Permission::firstOrCreate(["name"=>"Create Chapter","module_id"=>$chapter->id]);
        Permission::firstOrCreate(["name"=>"Update Chapter","module_id"=>$chapter->id]);
        Permission::firstOrCreate(["name"=>"Delete Chapter","module_id"=>$chapter->id]);

        $permissionList= [
            "Access Chapter",
            "Access Subject Wise Chapter",
            "Create Chapter",
            "Update Chapter",
            "Delete Chapter",
        ];
        $adminRole->givePermissionTo($permissionList);
        $teacherRole->givePermissionTo($permissionList);

        Artisan::call("cache:clear");
    }
}
