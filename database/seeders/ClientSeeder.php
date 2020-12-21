<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Str;
use Faker\Factory as Faker;
use App\Models\Role;
use App\Models\Client;

class ClientSeeder extends Seeder
{
    public function run(){
        $role_user = Role::where('name', 'client')->first();

        foreach($role_user->users as $user){
            $client = new Client();
            $client = Client::factory()->create(['user_id' => $user->id]);
            $client->save();
        }
    }
}
