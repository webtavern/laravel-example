<?php
use AttendanceSystem\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new Role();
        $admin->name = 'Admin';
        $admin->slug = 'admin';
        $admin->save();

        $master = new Role();
        $master->name = 'Master';
        $master->slug = 'master';
        $master->save();

        $worker = new Role();
        $worker->name = 'Worker';
        $worker->slug = 'worker';
        $worker->save();
    }
}
