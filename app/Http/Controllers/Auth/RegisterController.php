<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


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

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => 'required|string|min:2|max:191',
            'middle_name'  => 'required|string|min:5|max:1000',
            'last_name' => 'required|string|min:2|max:191',
            'DOB'  => 'required|string|min:5|max:1000',
            'gender' => 'required|string|min:2|max:191',
            'address'  => 'required|string|min:5|max:1000',
            'postcode' => 'required|string|min:2|max:191',
            'country'  => 'required|string|min:5|max:1000',
            'email' => 'required|string|unique:users,email|min:2|max:191',
            'phone'  => 'required|string|min:5|max:1000',
            'password'  => 'required|string|min:5|max:1000',
        ]);
        // return Validator::make($data, [
        //     'name' => ['required', 'string', 'max:255'],
        //     'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        //     'password' => ['required', 'string', 'min:8', 'confirmed'],
        // ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        
        return User::create([
            'first_name' => $data['first_name'],
            'middle_name' => $data['middle_name'],
            'last_name' => $data['last_name'],
            'DOB' => $data['DOB'],
            'gender' => $data['gender'],
            'address' => $data['address'],
            'postcode' => $data['postcode'],
            'country' => $data['country'],
            'email' => $data['email'],
            'phone' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
