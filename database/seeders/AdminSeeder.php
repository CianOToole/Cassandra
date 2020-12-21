<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Employee;

class AdminSeeder extends Seeder{
    public function run(){
        $role_user = Role::where('name', 'admin')->first();

        foreach($role_user->users as $user){
            $admin = new Employee();
            $admin = Employee::factory()->create(['user_id' => $user->id]);
            $admin->save();
        }
    }

}
