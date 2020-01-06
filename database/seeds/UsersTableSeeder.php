<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use AttendanceSystem\Models\Role;
use AttendanceSystem\Models\Permission;
use AttendanceSystem\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        DB::table('users')->insert([
//            'name' => 'Admin Admin',
//            'email' => 'admin@material.com',
//            'email_verified_at' => now(),
//            'password' => Hash::make('secret'),
//            'created_at' => now(),
//            'updated_at' => now()
//        ]);

        $admin = Role::where('slug','admin')->first();
        $master = Role::where('slug', 'master')->first();
        $worker = Role::where('slug', 'worker')->first();

        $all = Permission::where('slug','all')->first();
        $createTasks = Permission::where('slug','create-tasks')->first();
        $processingTasks = Permission::where('slug','processing-tasks')->first();

        $user1 = new User();
        $user1->name = 'John Smith';
        $user1->email = 'john@smith.com';
        $user1->password = bcrypt('secret');
        $user1->save();
        $user1->roles()->attach($admin);
        $user1->permissions()->attach($all);

        $user2 = new User();
        $user2->name = 'Mike Thomas';
        $user2->email = 'mike@thomas.com';
        $user2->password = bcrypt('secret');
        $user2->save();
        $user2->roles()->attach($master);
        $user2->permissions()->attach($createTasks);

        $user3 = new User();
        $user3->name = 'Frank Richards';
        $user3->email = 'frank@richards.com';
        $user3->password = bcrypt('secret');
        $user3->save();
        $user3->roles()->attach($worker);
        $user3->permissions()->attach($processingTasks);
    }
}
