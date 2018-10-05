<?php

use Illuminate\Database\Seeder;
use App\permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $permission_staff = new permission();
       $permission_staff->name = 'staff';
       $permission_staff->save();

       $permission_manager = new permission();
       $permission_manager->name = 'manager';
       $permission_manager->save();
    }
}
