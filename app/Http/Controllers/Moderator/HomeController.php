<?php

namespace App\Http\Controllers\Moderator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Balance;
use App\Models\Trade;
use App\Services\UserBalanceService;
use App\Services\TradeService;
Use Auth;
// return view('moderator.home');

class HomeController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
        $this->middleware('role:moderator');
    }

    public function index(){
        $balances = Balance::where('user_id', Auth::id())->get();
        $trades = Trade::where('user_id', '=', Auth::id())->where('tradeClosed', '=', false)->get();
        $gainLoss = (new TradeService())->calProfitLoss();
        $portfolioCash = 0;
        foreach ($trades as $trade) {
            $portfolioCash = $trade->amount;
        }
        $portfolioCash += $gainLoss;
        if ($balances[0]->amount >  0) {
            return view('moderator.home',[
                'trades' => $trades,
                'balances' => $balances,
                'gainLoss' => $gainLoss,
                'portfolioCash' => $portfolioCash
            ]);
        } else {
            $balance = new Balance;
            $balance->type_of_currency = "Euro";
            $balance->amount = 100000.0;
            $balance->user_id = Auth::id();
            $balance->save();
        }
       
        return view('moderator.home',[
            'trades' => $trades,
            'balances' => $balances,
            'gainLoss' => $gainLoss,
            'portfolioCash' => $portfolioCash
        ]);
    }
}
