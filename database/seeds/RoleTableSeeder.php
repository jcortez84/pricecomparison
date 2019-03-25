<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $role_employee = new Role();
      $role_employee->name = 'manager';
      $role_employee->description = 'A Manager User';
      $role_employee->save();
      $role_manager = new Role();
      $role_manager->name = 'employee';
      $role_manager->description = 'An Employee User';
      $role_manager->save();
      $role_employee = new Role();
      $role_employee->name = 'customer';
      $role_employee->description = 'A Manager User';
      $role_employee->save();
      $role_manager = new Role();
      $role_manager->name = 'merchant';
      $role_manager->description = 'An Employee User';
      $role_manager->save();

      $manager = new RoleUser();
      $manager->role_id = 1;
      $manager->user_id = 1;
      $manager->save();
    }
}
