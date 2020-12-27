<?php

namespace App\Http\Controllers\Moderator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Client;
use App\Models\Role;
use Hash;
use Illuminate\Support\Facades\DB;
use Storage;

class ClientController extends Controller{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:moderator');  
    }

    public function index(){
        $users = DB::table('users')
        ->join('clients', 'users.id', '=', 'clients.user_id')
        ->orderBy('users.surname')
        ->select('users.*', 'clients.name', 'clients.middle_name', 'clients.DOB', 'clients.gender', 'clients.isExperienced', 'clients.isBanned') 
        ->join('user_role', 'users.id', '=', 'user_role.user_id')
        ->where('role_id', 3)
        ->paginate(8);


    return view('moderator.clients.index',[
        'users' => $users,
    ]);
    }

    public function show($id){
        $client = DB::table('users')        
        ->join('clients', 'users.id', '=', 'clients.user_id')
        ->select("users.*",  'clients.name', 'clients.middle_name', 'clients.DOB', 'clients.gender', 'clients.postcode', 'clients.country', 'clients.isExperienced', 'clients.isBanned')      
        ->where('users.id', $id)
        ->get();

        return view('moderator.clients.show',[
            'client' => $client,
        ]);   
    }


    public function create(){
        return view('moderator.clients.create');
    }


    public function store(Request $request){
        $role = Role::where('name', 'client')->first();

        $request->validate([
            'name' => ['required', 'string', 'max:50'],
            'middle_name' => ['required', 'string', 'max:50'],
            'surname' => ['required', 'string', 'max:50'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required','string', 'unique:users'],
            'address' => ['required', 'string', 'max:255'],
            'postcode' => ['required', 'alpha_num', 'min:8', 'max:12'],
            'country' => ['required'],
            'DOB' => ['required'],
            'gender' => ['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        
        $user = new User();
        $user->surname = $request->input('surname');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->address = $request->input('address');
        $user->password = Hash::make($request['password']);
        $user->save();
        $user->roles()->attach($role);

        $client = new Client();
        $client->name = $request->input('name');
        $client->middle_name = $request->input('middle_name');
        $client->DOB = $request->input('DOB');
        $client->gender = $request->input('gender');
        $client->postcode = $request->input('postcode');
        $client->country = $request->input('country');        
        $client->isExperienced = 0;        
        $client->isBanned = 0;        
        $client->user_id = $user->id;
        $client->save();

        $request->session()->flash('success', 'Client added successfully!');

        return redirect()->route('moderator.clients.index');
    }


    public function edit($id){
        $client = DB::table('users')        
        ->join('clients', 'users.id', '=', 'clients.user_id')
        ->select("users.*", 'clients.name', 'clients.middle_name', 'clients.DOB', 'clients.gender', 'clients.postcode', 'clients.country', 'clients.isExperienced', 'clients.isBanned')      
        ->where('users.id', $id)
        ->get();

        return view('moderator.clients.edit',[
            'client' => $client
        ]);
    }


    public function update(Request $request, $id){
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'middle_name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', "unique:users,phone, $id"],
            'email' => ['required', 'email', 'max:255', "unique:users,email, $id"],
            'address' => ['required', 'string', 'max:255'],
            'postcode' => ['required', 'alpha_num', 'min:8', 'max:12'],
            'country' => ['required'],
            'DOB' => ['required'],
            'gender' => ['required'],
        ]);

        $user = User::findOrFail($id);
        $user->surname = $request->input('surname');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->address = $request->input('address');
        $user->save();

        $client = Client::where('user_id', $id)->firstOrFail();
        $client->name = $request->input('name');
        $client->middle_name = $request->input('middle_name');
        $client->DOB = $request->input('DOB');
        $client->gender = $request->input('gender');
        $client->postcode = $request->input('postcode');
        $client->country = $request->input('country');        
        $client->save();

        $request->session()->flash('info', 'Client edited successfully!');
        return redirect()->route('moderator.clients.index');
    }


    public function destroy(Request $request, $id){
        // $visits = Visit::where('doctor_id', $id)->get();

        // foreach($visits as $visit){
        //     echo($visit);
        //     $visit->delete();
        // }
        $client = Client::where('user_id', $id)->firstOrFail();
        $client->delete();

        $user = User::where('id', $client->user_id)->get();
        $user[0]->roles()->detach();
        Storage::delete("public/avatar/{$user[0]->avatar}");
        $user[0]->delete();

        $request->session()->flash('danger', 'Client removed successfully!');
        return redirect()->route('moderator.clients.index');
    }

    public function banning(Request $request, $id){

        $client = Client::where('user_id', $id)->firstOrFail();
        $client->isBanned = $request->input('isBanned');
        $client->save();

        $request->session()->flash('info', 'Client ban successfully!');
        return redirect()->route('moderator.clients.index');
    }

    public function unban(Request $request, $id){

        $client = Client::where('user_id', $id)->firstOrFail();
        $client->isBanned = $request->input('isBanned');
        $client->save();

        $request->session()->flash('info', 'Client unban successfully!');
        return redirect()->route('moderator.clients.index');
    }
}
