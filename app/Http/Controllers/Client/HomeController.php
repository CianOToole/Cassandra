<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
Use Auth;
use App\Models\Client;
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
        $balance = Balance::where('user_id', Auth::id())->get();
        
        if ($balance[0]->amount >  0) {
            return view('client.home',[
                'balance' => $balance[0],
            ]);
        } else {
            $balance = new Balance;
            $balance->type_of_currency = "Euro";
            $balance->amount = 100000.0;
            $balance->user_id = Auth::id();
            $balance->save();
        }
        $balance = Balance::where('user_id', Auth::id())->count();
        return view('client.home',[
            'balance' => $balance,
        ]);
        // return view('client.home');
    }
}
