<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use AttendanceSystem\Models\Role;
use AttendanceSystem\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin_id = Role::where('slug','admin')->first()->id;
        $master_id = Role::where('slug', 'master')->first()->id;
        $worker_id = Role::where('slug', 'worker')->first()->id;

        $all_id = Permission::where('slug','all')->first()->id;
        $createTasks_id = Permission::where('slug','create-tasks')->first()->id;
        $processingTasks_id = Permission::where('slug','processing-tasks')->first()->id;


        DB::table('role_permission')->insert([
            'role_id' => $admin_id,
            'permission_id' => $all_id,
        ]);

        DB::table('role_permission')->insert([
            'role_id' => $master_id,
            'permission_id' => $createTasks_id,
        ]);

        DB::table('role_permission')->insert([
            'role_id' => $worker_id,
            'permission_id' => $processingTasks_id,
        ]);
    }
}
