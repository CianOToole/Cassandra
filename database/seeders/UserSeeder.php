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
        // $admin->name = 'Yvan';
        // $admin->email = 'yvan@mail.ie';
        // $admin->password = Hash::make('secret');
        // $admin->save();
        // $admin->roles()->attach($role_admin);

        $admin->first_name = 'Yvan';
        $admin->middle_name = 'hkh';
        $admin->last_name = 'BOi';
        $admin->DOB  = '2000/04/10';
        $admin->gender = 'Yvan';
        $admin->address = 'sdfsdsdf';
        $admin->postcode = 'sfsdfsdf';
        $admin->country = 'Ireland';
        $admin->email = 'yvan@mail.ie';
        $admin->phone = '0862014993';
        $admin->password = Hash::make('secret');
        $admin->save();
        $admin->roles()->attach($role_admin); 


        $adminTwo = new User();
        // $adminTwo->name = 'Cian';
        // $adminTwo->email = 'cian@mail.ie';
        // $adminTwo->password = Hash::make('secret');
        // $adminTwo->save();
        // $adminTwo->roles()->attach($role_admin);

        $adminTwo->first_name = 'Mike';
        $adminTwo->middle_name = 'hkh';
        $adminTwo->last_name = 'BOi';
        $adminTwo->DOB  = '2000/04/10';
        $adminTwo->gender = 'Yvan';
        $adminTwo->address = 'sdfsdsdf';
        $adminTwo->postcode = 'sfsdfsdf';
        $adminTwo->country = 'Ireland';
        $adminTwo->email = 'mike@mail.ie';
        $adminTwo->phone = '0862014993';
        $adminTwo->password = Hash::make('secret');
        $adminTwo->save();
        $adminTwo->roles()->attach($role_admin);

        $user = new User();
        // $user->name = 'John';
        // $user->email = 'smith@mail.ie';
        // $user->password = Hash::make('secret');
        // $user->save();
        // $user->roles()->attach($role_user);

        $user->first_name = 'Cian';
        $user->middle_name = 'hkh';
        $user->last_name = 'BOi';
        $user->DOB  = '2000/04/10';
        $user->gender = 'Yvan';
        $user->address = 'sdfsdsdf';
        $user->postcode = 'sfsdfsdf';
        $user->country = 'Ireland';
        $user->email = 'cian@mail.ie';
        $user->phone = '0862014993';
        $user->password = Hash::make('secret');
        $user->save();
        $user->roles()->attach($role_user);
    }
}
