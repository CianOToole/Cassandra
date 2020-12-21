<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Employee;

class ModeratorSeeder extends Seeder{
    public function run(){
        $role_user = Role::where('name', 'moderator')->first();

        foreach($role_user->users as $user){
            $moderator = new Employee();
            $moderator = Employee::factory()->create(['user_id' => $user->id]);
            $moderator->save();
        }
    }

}
