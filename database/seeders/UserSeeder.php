<?php

namespace Database\Seeders;
use App\Models\User;
use App\Models\Role;
use Hash;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //db ,get me role where name = admin
        $role_admin = Role::where('name', 'admin')->first();
        $role_user = Role::where('name', 'user')->first();

        $admin = new User();
        $admin->name = 'Yvan';
        $admin->email = 'yvan@mail.ie';
        $admin->password = Hash::make('secret');
        $admin->save();
        $admin->roles()->attach($role_admin);

        $adminTwo = new User();
        $adminTwo->name = 'Cian';
        $adminTwo->email = 'cian@mail.ie';
        $adminTwo->password = Hash::make('secret');
        $adminTwo->save();
        $adminTwo->roles()->attach($role_admin);

        $user = new User();
        $user->name = 'John';
        $user->email = 'smith@mail.ie';
        $user->password = Hash::make('secret');
        $user->save();
        $user->roles()->attach($role_user);
    }
}
