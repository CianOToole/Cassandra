<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Storage;
use DB;
use App\Models\User;
use App\Models\Employee;

class ProfileController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin');  
    }

    public function profile(){
        $user = Auth::user();
        $admin = DB::table('employees')
            ->where('user_id', '=', $user->id)
            ->select('name', 'emp_number', 'salary')
            ->get();

        $posts = DB::table('posts')
            ->where('user_id', $user->id)
            ->select('posts.*')
            ->orderByDesc('updated_at')
            ->paginate(10);

        return view('admin.profiles.index', [
            'profile' => $user,
            'admin' => $admin,
            'posts' => $posts
            ]);
    }

    public function edit($id){
        $admin = User::findOrFail($id)
            ->join('employees', "users.id", '=', "employees.user_id")
            ->where('users.id', '=', $id)
            ->select('users.*', 'employees.name', 'employees.emp_number', 'employees.salary')
            ->get();

        return view('admin.profiles.edit',[
            'admin' => $admin
        ]);
    }


    public function update(Request $request, $id){

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'email' => 'required|string|email|max:255',
            'phone' => ['required','string'],
            'address' => ['required', 'string', 'max:255'],
            'emp_number' => ['required', 'alpha_num', 'min:5', 'max:5'],
            'salary' => 'required',
            'avatar' => 'file|image'
        ]);

        $user = User::findOrFail($id);

        if($request->hasFile('avatar')){
            Storage::delete("public/avatar/{$user->avatar}");
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

        $admin = Employee::where('user_id', $id)->firstOrFail();
        $admin->name = $request->input('name');
        $admin->emp_number = $request->input('emp_number');
        $admin->salary = $request->input('salary');
        $admin->save();

        $request->session()->flash('info', 'Profile edited successfully!');

        return redirect()->route('admin.profiles.index');
    }
}
