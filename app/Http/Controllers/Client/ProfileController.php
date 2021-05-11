<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Storage;
use DB;
use App\Models\User;
use App\Models\Client;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:client');  
    }

    public function profile(){
        $user = Auth::user();
        $client = DB::table('clients')
            ->where('user_id', '=', $user->id)
            ->select('name', 'middle_name', 'DOB', 'gender', 'postcode', 'country', 'isExperienced', 'isBanned')
            ->get();

        $posts = DB::table('posts')
            ->where('user_id', $user->id)
            ->select('posts.*')
            ->orderByDesc('updated_at')
            ->paginate(10);

        return view('client.profiles.index', [
            'profile' => $user,
            'client' => $client,
            'posts' => $posts
            ]);
    }

    public function edit($id){
        $client = User::findOrFail($id)
            ->join('clients', "users.id", '=', "clients.user_id")
            ->where('users.id', '=', $id)
            ->select('users.*', 'clients.name', 'clients.middle_name', 'clients.DOB', 'clients.gender', 'clients.postcode', 'clients.country')
            ->get();

        return view('client.profiles.edit',[
            'client' => $client
        ]);
    }


    public function update(Request $request, $id){
        $user = User::findOrFail($id);

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'middle_name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone' => ['required','string'],
            'address' => ['required', 'string', 'max:255'],
            'postcode' => ['required', 'alpha_num', 'min:8', 'max:12'],
            'country' => ['required'],
            'DOB' => ['required'],
            'gender' => ['required'],
            'profile_picture' => 'file|image',
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

        $client = Client::where('user_id', $id)->firstOrFail();
        $client->name = $request->input('name');
        $client->middle_name = $request->input('middle_name');
        $client->DOB = $request->input('DOB');
        $client->gender = $request->input('gender');
        $client->postcode = $request->input('postcode');
        $client->country = $request->input('country');        
        $client->save();

        $request->session()->flash('info', 'Profile edited successfully!');

        return redirect()->route('client.profiles.index');
    }
}
