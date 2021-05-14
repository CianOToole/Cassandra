<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use App\Models\Balance;
use Hash;
use Illuminate\Support\Facades\DB;

class BalanceSeeder extends Seeder{

    public function run(){
        
        // each user is given 10000.00€
        for($i = 1; $i < 63 ; $i++){
            $balance = new Balance();
            $balance->type_of_currency  = "Euro";
            $balance->amount  = 10000.00;
            $balance->user_id  = $i;
            $balance->save();
        }
    }

}
