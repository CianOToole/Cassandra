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

    // ProfileController is used throughout the user roles, it manages the profile page, from displayong the personal data, to the 
    // edit form, as ell as retrieving the old post written by the user

    // profile get the user personnal data & previosu posts
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

    // the edit function retrieve the user personnal data that are then displayed within the input fields
    // see edit.blade files on the profile folders 
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

// update determines what rules the user the request data must folow
// e.g. line 72 checks the uniqueness of the employees number. Hence, a user cannot enter anither user's id if it is already taken, unless its his.
// the employee number can be alpha-numerical, and must be 5 characters long.
// line 8à to 88 manages a new profile picture
// if the form send a new profile picture, the function deleted any previous profile picture, gets its file extension and plug to its name the date when the image was uploaded.
//  the image is then stored in a specific folder and sent to the database
// once the request data is verified, a $user object storing all the details is sent to the database for storage
    public function update(Request $request, $id){

        $user = User::findOrFail($id);

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'email' => 'required|string|email|max:255',
            'phone' => ['required','string'],
            'address' => 'required|string|max:35|unique:users,address,' . $user->id,
            'emp_number' => 'required|alpha_num|min:5|max:5|unique:employees,emp_number,' . $user->id,
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

        $admin = Employee::where('user_id', $id)->firstOrFail();
        $admin->name = $request->input('name');
        $admin->emp_number = $request->input('emp_number');
        $admin->salary = $request->input('salary');
        $admin->save();

        $request->session()->flash('info', 'Profile edited successfully!');

        return redirect()->route('admin.profiles.index');
    }
}
