<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Balance;
use Illuminate\Http\Request;
Use Auth;

class HomeController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
        $this->middleware('role:admin');
    }

    public function index(){
        $balance = Balance::where('user_id', Auth::id())->get();
        
        if ($balance[0]->amount >  0) {
            return view('admin.home',[
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
        return view('admin.home',[
            'balance' => $balance,
        ]);
    }
}

