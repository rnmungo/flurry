<?php

use Illuminate\Database\Seeder;
use Flurry\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array_role_names = ["Admin", "Operator", "Supervisor", "Manager"];
        foreach($array_role_names as $role_name) {
            $role = new Role();
            $role->name = $role_name;
            $role->save();
        }
    }
}
