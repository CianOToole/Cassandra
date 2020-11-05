<?php

namespace App\Services;

use App\Models\Balance;
use Illuminate\Http\Request;
use Auth;

Class UserBalanceService {

    public function createUserBalance(){
        $balance = new Balance;
        $balance->type_of_currency = "Euro";
        $balance->amount = 100000.0;
        $balance->user_id = Auth::id();
        $balance->save();
    }


    public function addProfit(){

    }
    
    public function minusProfit(){

    }
}