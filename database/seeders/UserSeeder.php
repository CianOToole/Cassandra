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

        $admin->first_name = 'Yvan';
        $admin->middle_name = 'Angus';
        $admin->last_name = 'Monod';
        $admin->DOB  = '1998/09/12';
        $admin->gender = 'Male';
        $admin->address = 'test street';
        $admin->postcode = 'XNZ72';
        $admin->country = 'France';
        $admin->email = 'yvan@mail.com';
        $admin->phone = '9102716253';
        $admin->password = Hash::make('secret');
        $admin->save();
        $admin->roles()->attach($role_admin); 


        $adminTwo = new User();
        $adminTwo->first_name = 'Cian';
        $adminTwo->middle_name = 'Tupac';
        $adminTwo->last_name = 'OToole';
        $adminTwo->DOB  = '2001/11/01';
        $adminTwo->gender = 'Unkwon';
        $adminTwo->address = 'dev road';
        $adminTwo->postcode = 'DZD83D';
        $adminTwo->country = 'Ireland';
        $adminTwo->email = 'cian@mail.com';
        $adminTwo->phone = '01826749281';
        $adminTwo->password = Hash::make('secret');
        $adminTwo->save();
        $adminTwo->roles()->attach($role_admin);

        $user = new User();
        $user->first_name = 'John';
        $user->middle_name = 'Delano';
        $user->last_name = 'Smith';
        $user->DOB  = '1992/04/10';
        $user->gender = 'Male';
        $user->address = 'somewhere';
        $user->postcode = 'DJZ72D';
        $user->country = 'Ireland';
        $user->email = 'smith@mail.com';
        $user->phone = '0862014993';
        $user->password = Hash::make('secret');
        $user->save();
        $user->roles()->attach($role_user);
    }
}
