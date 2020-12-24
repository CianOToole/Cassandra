<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
Use Auth;
use App\Models\Client;


class HomeController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
        $this->middleware('role:client');
    }

    public function index(){
        $auth = Auth::user();
        $user = Client::where('user_id', '=', $auth->id)->firstOrFail();
        $banning_state = $user->isBanned;
        
        return view('client.home', ['banning_state' => $banning_state]);
    }
}
