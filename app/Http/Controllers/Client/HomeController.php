<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
Use Auth;
use App\Models\Client;
use App\Models\Trade;
use App\Services\UserBalanceService;
use App\Services\TradeService;
use App\Models\Balance;


class HomeController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
        $this->middleware('role:client');
    }

    public function index(){
        // $auth = Auth::user();
        // $user = Client::where('user_id', '=', $auth->id)->firstOrFail();
        // $banning_state = $user->isBanned;
        
        // return view('client.home', ['banning_state' => $banning_state]);
        $balances = Balance::where('user_id', Auth::id())->get();
        $trades = Trade::where('user_id', '=', Auth::id())->where('tradeClosed', '=', false)->get();
        $gainLoss = (new TradeService())->calProfitLoss();
        $portfolioCash = 0;
        foreach ($trades as $trade) {
            $portfolioCash = $trade->amount;
        }
        $portfolioCash += $gainLoss;
        if ($balances[0]->amount >  0) {
            return view('client.home',[
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
      
        return view('client.home',[
            'trades' => $trades,
            'balances' => $balances,
            'gainLoss' => $gainLoss,
            'portfolioCash' => $portfolioCash
        ]);
        // return view('client.home');
    }
}
