<?php

namespace App\Http\Controllers\Moderator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Balance;
Use Auth;
// return view('moderator.home');

class HomeController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
        $this->middleware('role:moderator');
    }

    public function index(){
        $balance = Balance::where('user_id', Auth::id())->get();
        
        if ($balance[0]->amount >  0) {
            return view('moderator.home',[
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
        return view('moderator.home',[
            'balance' => $balance,
        ]);
    }
}
