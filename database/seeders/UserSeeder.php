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

        $role_admin = Role::where('name', 'admin')->first();
        $role_moderator = Role::where('name', 'moderator')->first();
        $role_client = Role::where('name', 'client')->first();

        $admin = new User();
        // $admin->name = 'John';
        $admin->surname = 'Smith';
        $admin->address = '123 No Where Street';
        $admin->phone  = '000-0000-000';
        $admin->email = 'smith@mail.com';
        $admin->password = Hash::make('secret');
        $admin->save();
        $admin->roles()->attach($role_admin); 

        $moderator = new User();
        // $moderator->name = 'Angus';
        $moderator->surname = 'McFiffe';
        $moderator->address = '88 Lost Road';
        $moderator->phone  = '111-1111-111';
        $moderator->email = 'mcfiffe@mail.com';
        $moderator->password = Hash::make('secret');
        $moderator->save();
        $moderator->roles()->attach($role_moderator); 

        $client = new User();
        // $client->name = 'Niamh';
        $client->surname = 'Farelly';
        $client->address = '12 Abandonned Path';
        $client->phone  = '222-2222-222';
        $client->email = 'farelly@mail.com';
        $client->password = Hash::make('secret');
        $client->save();
        $client->roles()->attach($role_client); 

        for($i = 1; $i <=4 ; $i++){
            $admin = User::factory()->create();
            $admin->roles()->attach($role_admin);
        }

        for($i = 1; $i <= 9 ; $i++){
            $moderator = User::factory()->create();
            $moderator->roles()->attach($role_moderator);
        }

        for($i = 1; $i <= 49 ; $i++){
            $client = User::factory()->create();
            $client->roles()->attach($role_client);
        }

    }
}
