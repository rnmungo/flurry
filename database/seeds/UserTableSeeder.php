<?php

use Illuminate\Database\Seeder;
use Flurry\Role;
use Flurry\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_user = Role::where('name', 'Operator')->first();
        $role_admin = Role::where('name', 'Admin')->first();
        $role_manager = Role::where('name', 'Manager')->first();
        $role_supervisor = Role::where('name', 'Supervisor')->first();

        $user = new User();
        $user->name = 'Luciano';
        $user->email = 'lhorvath@gmail.com';
        $user->password = bcrypt('Lucho1234');
        $user->role_id = $role_admin->id;
        $user->avatar = 'heisenberg.png';
        $user->random_id = uniqid(str_random(17));
        $user->save();

        $user = new User();
        $user->name = 'Rodrigo';
        $user->email = 'rodrigomungo@gmail.com';
        $user->password = bcrypt('Rocky1995');
        $user->role_id = $role_admin->id;
        $user->avatar = 'chico.png';
        $user->random_id = uniqid(str_random(17));
        $user->save();

        $user = new User();
        $user->name = 'Operador';
        $user->email = 'operador@gmail.com';
        $user->password = bcrypt('operador');
        $user->role_id = $role_user->id;
        $user->random_id = uniqid(str_random(17));
        $user->save();

        $user = new User();
        $user->name = 'Manager';
        $user->email = 'manager@gmail.com';
        $user->password = bcrypt('manager');
        $user->role_id = $role_manager->id;
        $user->random_id = uniqid(str_random(17));
        $user->save();

        $user = new User();
        $user->name = 'Supervisor';
        $user->email = 'supervisor@gmail.com';
        $user->password = bcrypt('supervisor');
        $user->role_id = $role_supervisor->id;
        $user->random_id = uniqid(str_random(17));
        $user->save();
    }
}
