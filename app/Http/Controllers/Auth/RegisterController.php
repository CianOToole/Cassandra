<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Role;
use App\Models\Client;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Balance;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'surname' => 'required|string|min:2|max:55',
            'address'  => 'required|string|min:5|max:100',
            'email' => 'required|email|unique:users,email',
            'phone'  => 'required|string|min:5|max:25',
            'password'  => 'required|string|min:8|max:25',
        ]);

    }

    protected function create(array $data)
    {
        
        $user =  User::create([
            'surname' => $data['surname'],
            'address' => $data['address'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => Hash::make($data['password']),
        ]);

        $user->roles()->attach(Role::where('name','client')->first());

        $client = new Client();
        $client->isExperienced = 0;
        $client->isBanned = 0;
        $client->user_id = $user->id;
        $client->save();

        $balance = new Balance();
        $balance->type_of_currency  = "Euro";
        $balance->amount  = 10000.00;
        $balance->user_id  = $user->id;
        $balance->save();

        return $user;
    }
}
