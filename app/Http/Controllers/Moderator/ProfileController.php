<?php

namespace App\Http\Controllers\Moderator;

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
        $this->middleware('role:moderator');  
    }

    public function profile(){
        $user = Auth::user();
        $moderator = DB::table('employees')
            ->where('user_id', '=', $user->id)
            ->select('name', 'emp_number', 'salary')
            ->get();

        $posts = DB::table('posts')
            ->where('user_id', $user->id)
            ->select('posts.*')
            ->orderByDesc('updated_at')
            ->paginate(10);

        return view('moderator.profiles.index', [
            'profile' => $user,
            'moderator' => $moderator,
            'posts' => $posts
            ]);
    }

    public function edit($id){
        $moderator = User::findOrFail($id)
            ->join('employees', "users.id", '=', "employees.user_id")
            ->where('users.id', '=', $id)
            ->select('users.*', 'employees.name', 'employees.emp_number', 'employees.salary')
            ->get();

        return view('moderator.profiles.edit',[
            'moderator' => $moderator
        ]);
    }


    public function update(Request $request, $id){
        $user = User::findOrFail($id);
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'email' => 'required|string|email|max:255',
            'phone' => ['required','string'],
            'address' => 'required|string|max:35|unique:users,address,' . $user->id,
            'emp_number' => 'required|alpha_num|min:5|max:5',
            'salary' => 'required',
            'avatar' => 'file|image'
        ]);

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

        $moderator = Employee::where('user_id', $id)->firstOrFail();
        $moderator->name = $request->input('name');
        $moderator->emp_number = $request->input('emp_number');
        $moderator->salary = $request->input('salary');
        $moderator->save();

        $request->session()->flash('info', 'Profile edited successfully!');

        return redirect()->route('moderator.profiles.index');
    }
}
