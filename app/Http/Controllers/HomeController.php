<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $user = Auth::user();
        $home = 'home';

        if($user->hasRole('admin')){
            $home = 'admin.home';
        }else if($user->hasRole('user')){
            $home = 'user.home';
        }

        return redirect()->route($home);
    }
}
