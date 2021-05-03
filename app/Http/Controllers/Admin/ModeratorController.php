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
