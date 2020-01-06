<?php
use AttendanceSystem\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $all = new Permission();
        $all->name = 'All';
        $all->slug = 'all';
        $all->save();

        $createTasks = new Permission();
        $createTasks->name = 'Create Tasks';
        $createTasks->slug = 'create-tasks';
        $createTasks->save();

        $processingTasks = new Permission();
        $processingTasks->name = 'Processing Tasks';
        $processingTasks->slug = 'processing-tasks';
        $processingTasks->save();
    }
}
