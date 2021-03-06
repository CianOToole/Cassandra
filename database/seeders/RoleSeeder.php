<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    // the roles determine a users rights and bilities to interact with the platorm, as well as features
    public function run()
    {
        $role_admin = new Role();
        $role_admin->name = 'admin';
        $role_admin->description = 'An administrator user';
        $role_admin->save();

        $role_admin = new Role();
        $role_admin->name = 'moderator';
        $role_admin->description = 'A moderator user';
        $role_admin->save();

        $user = new Role();
        $user->name = 'client';
        $user->description = 'An ordinary user';
        $user->save();
    }
}
