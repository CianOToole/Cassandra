<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use App\Models\Employee;
use App\Models\Client;
use App\Models\Balance;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(){ 
        $this->call([            
            RoleSeeder::class,
            UserSeeder::class,
            AdminSeeder::class,
            ModeratorSeeder::class,
            ClientSeeder::class,
            BoardSeeder::class,
            TopicSeeder::class,
            BalanceSeeder::class,
        ]);
    }
}
