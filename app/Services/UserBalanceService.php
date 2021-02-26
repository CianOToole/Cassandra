<?php

namespace App\Services;

use App\Models\Balance;
use App\Models\Trade;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class UserBalanceService
{

    public function createUserBalance()
    {
        $balance = Balance::where('user_id', Auth::id())->count();
        if ($balance > 0) {
            return;
        } else {
            $balance = new Balance;
            $balance->type_of_currency = "Euro";
            $balance->amount = 100000.0;
            $balance->user_id = Auth::id();
            $balance->save();
        }
    }


    public function addProfit($trade)
    {
        $stockPast = Stock::findOrFail($trade->stock_id);
        $stock = Stock::where('ticker', $stockPast->ticker)->get();
        $id = $stock->count();
        $stockNow = Stock::findOrFail($stock[$id-1]->id);
        $sharePerStock = ($trade->amount / $stockPast->price);
        $addToBalance = $sharePerStock * $stockNow->price;
        $balance = Balance::where('user_id', Auth::id())->firstOrFail();
        $balance->amount += $addToBalance; 
        $balance->save();
        $trade->delete();
    }

    public function minusProfit($request)
    {
        $balance = Balance::where('user_id', Auth::id())->firstOrFail();
        $balance->amount -= $request->amount;
        $balance->save();
    }
}
