<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Client;
use App\Models\Role;
use App\Models\Post;
use App\Models\Topic;
use Hash;
use Illuminate\Support\Facades\DB;
use Storage;

class ClientController extends Controller{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin');  
    }


    public function index(){

        $users = DB::table('users')
            ->join('clients', 'users.id', '=', 'clients.user_id')
            ->orderBy('users.surname')
            ->select('users.*', 'clients.name', 'clients.middle_name', 'clients.DOB', 'clients.gender', 'clients.isExperienced', 'clients.isBanned') 
            ->join('user_role', 'users.id', '=', 'user_role.user_id')
            ->where('role_id', 3)
            ->paginate(10);

        return view('admin.clients.index',[
            'users' => $users,
        ]);

    }

    
    public function show($id){

        $client = DB::table('users')        
        ->join('clients', 'users.id', '=', 'clients.user_id')
        ->select("users.*",  'clients.name', 'clients.middle_name', 'clients.DOB', 'clients.gender', 'clients.postcode', 'clients.country', 'clients.isExperienced', 'clients.isBanned')      
        ->where('users.id', $id)
        ->get();

        return view('admin.clients.show',[
            'client' => $client,
        ]);     

    }


    public function destroy(Request $request, $id){
        $client = Client::where('user_id', $id)->firstOrFail();
        $client->delete();


        $user = User::where('id', $client->user_id)->get();
        $posts = Post::where('user_id', $user[0]->id)->get();

        foreach ($posts as $post) {
            $post->delete();
        } 

        $topics = Topic::where('user_id', $user[0]->id)->get();

        foreach ($topics as $topic) {
            $posts = Post::where('topic_id', $topic->id)->get();
            foreach ($posts as $post) {
                $post->delete();
            }
            $topic->delete();
        } 

        $user[0]->roles()->detach();
        Storage::delete("public/avatar/{$user[0]->avatar}");
    
        $user[0]->delete();

        $request->session()->flash('danger', 'Client removed successfully!');
        return redirect()->route('admin.clients.index');
    }

    public function banning(Request $request, $id){

        $client = Client::where('user_id', $id)->firstOrFail();
        $client->isBanned = $request->input('isBanned');
        $client->save();
        
        $request->session()->flash('info', 'Client ban successfully!');
        return redirect()->route('admin.clients.index');
    }

    public function unban(Request $request, $id){

        $client = Client::where('user_id', $id)->firstOrFail();
        $client->isBanned = $request->input('isBanned');
        $client->save();

        $request->session()->flash('info', 'Client unban successfully!');
        return redirect()->route('admin.clients.index');
    }


}
