<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Employee;
use App\Models\Role;
use Hash;
use Illuminate\Support\Facades\DB;
use Storage;

class ModeratorController extends Controller{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin');  
    }


    public function index(){

        $users = DB::table('users')
            ->join('employees', 'users.id', '=', 'employees.user_id')
            ->orderBy('users.surname')
            ->select('users.*', 'employees.name', 'employees.emp_number', 'employees.salary')        
            ->join('user_role', 'users.id', '=', 'user_role.user_id')
            ->where('role_id', 2)
            ->paginate(8);


        return view('admin.moderators.index',[
            'users' => $users,
        ]);

    }

    
    public function show($id){

        $moderator = DB::table('users')        
        ->join('employees', 'users.id', '=', 'employees.user_id')
        ->select("users.*",  'employees.name', 'employees.emp_number', 'employees.salary')
        ->where('users.id', $id)
        ->get();

        return view('admin.moderators.show',[
            'moderator' => $moderator,
        ]);     

    }

    public function create(){
        return view('admin.moderators.create');
    }


    public function store(Request $request){
        $role = Role::where('name', 'moderator')->first();

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required','string', 'unique:users'],
            'address' => ['required', 'string', 'max:255'],
            'emp_number' => 'required|alpha_num|min:5|max:5|unique:employees',
            'salary' => 'required',
            'avatar' => 'file|image',
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        
        $avatar = $request->file('avatar');
        $extension = $avatar->getClientOriginalExtension();
        $filename = date('Y-m-d-His') . $extension;

        $path = $avatar->storeAs('public/avatar', $filename);
            

        $user = new User();
        $user->surname = $request->input('surname');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->address = $request->input('address');
        $user->avatar = $filename;
        $user->password = Hash::make($request['password']);
        $user->save();
        $user->roles()->attach($role);

        $moderator = new Employee();
        $moderator->name = $request->input('name');
        $moderator->emp_number = $request->input('emp_number');
        $moderator->salary = $request->input('salary');
        $moderator->user_id = $user->id;
        $moderator->save();

        $request->session()->flash('success', 'Moderator added successfully!');

        return redirect()->route('admin.moderators.index');
    }


    public function edit($id){

        $moderator = DB::table('users')        
        ->join('employees', 'users.id', '=', 'employees.user_id')
        ->select("users.*",  'employees.name', 'employees.emp_number', 'employees.salary')
        ->where('users.id', $id)
        ->get();

        return view('admin.moderators.edit',[
            'moderator' => $moderator
        ]);

    }


    public function update(Request $request, $id){
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', "unique:users,phone, $id"],
            'email' => ['required', 'email', 'max:255', "unique:users,email, $id"],
            'address' => ['required', 'string', 'max:255'],
            'emp_number' => ['required', 'alpha_num', 'min:5', 'max:5'],
            'salary' => 'required',
            'avatar' => 'file|image',
        ]);

        $user = User::findOrFail($id);

        if($request->hasFile('avatar')){

            $avatar = $request->file('avatar');
            $extension = $avatar->getClientOriginalExtension();
            $filename = date('Y-m-d-His') . $extension;

            $path = $avatar->storeAs('public/avatar', $filename);
            $user->avatar = $filename;
        }

        $user->surname = $request->input('surname');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->address = $request->input('address');
        $user->save();

        $moderator = Employee::where('user_id', $id)->firstOrFail();
        $moderator->name = $request->input('name');
        $moderator->emp_number = $request->input('emp_number');
        $moderator->salary = $request->input('salary');
        $moderator->save();

        $request->session()->flash('info', 'Moderator edited successfully!');
        return redirect()->route('admin.moderators.index');

    }


    public function destroy(Request $request, $id){
        // $visits = Visit::where('doctor_id', $id)->get();

        // foreach($visits as $visit){
        //     echo($visit);
        //     $visit->delete();
        // }

        $moderator = Employee::where('user_id', $id)->firstOrFail();
        $moderator->delete();

        $user = User::where('id', $moderator->user_id)->get();
        $user[0]->roles()->detach();
        Storage::delete("public/avatar/{$user[0]->avatar}");
        $user[0]->delete();

        $request->session()->flash('danger', 'Moderator removed successfully!');
        return redirect()->route('admin.moderators.index');
    }
}
