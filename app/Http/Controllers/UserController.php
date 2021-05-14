<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Services\UserBalanceService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->paginate(8);
        return view('users.index', [
            'users' => $users
        ]);
    }


    public function create()
    {
        return view('users.create');
    }


    public function store(Request $request)
    {
        //validation rules
        $rules = [
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
        ];
        //custom validation error messages
        $messages = [
            'email.unique' => 'User title should be unique', //syntax: field_name.rule
        ];
        //First Validate the form data
        $request->validate($rules, $messages);
        //Create a Todo
        $user = new User;
        $user->first_name = $request->first_name;
        $user->middle_name = $request->middle_name;
        $user->last_name = $request->last_name;
        $user->DOB = $request->DOB;
        $user->gender = $request->gender;
        $user->address = $request->address;
        $user->postcode = $request->postcode;
        $user->country = $request->country;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = Hash::make($request->password);
        $user->save(); // save it to the database.
        //Redirect to a specified route with flash message.
        (new UserBalanceService())->createUserBalance();
        return redirect()
            ->route('users.index')
            ->with('status', 'Created a new user!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('users.show', [
            'user' => $user,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', [
            'user' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
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
        ];
        
        $messages = [
            'title.unique' => 'Todo title should be unique',
        ];

        $request->validate($rules,$messages);
        $user = User::findOrFail($id);
        $user->first_name = $request->first_name;
        $user->middle_name = $request->middle_name;
        $user->last_name = $request->last_name;
        $user->DOB = $request->DOB;
        $user->gender = $request->gender;
        $user->address = $request->address;
        $user->postcode = $request->postcode;
        $user->country = $request->country;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = $request->password;
        $user->save();

        return redirect()
            ->route('users.show', $id)
            -> with('status','Updated the selected user');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        //Redirect to a specified route with flash message.
        return redirect()
            ->route('users.index')
            -> with('status','Deleted the selected user');
    }
}
