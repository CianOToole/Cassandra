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

    // ClientController manages all the logic necessary for the admin/moderator role to retrieve, view, (un)ban and delete the cleint profiles

    // index get all the user whose user role is client (line 34)
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

    // show work similarly to index, but retrieve one user instead of many by passing to the function the user id as a parameter
    // further more, the function gets all the posts that the user made
    public function show($id){

        $client = DB::table('users')        
        ->join('clients', 'users.id', '=', 'clients.user_id')
        ->select("users.*",  'clients.name', 'clients.middle_name as mn', 'clients.DOB as dob', 'clients.gender', 'clients.postcode', 'clients.country', 'clients.isExperienced', 'clients.isBanned')      
        ->where('users.id', $id)
        ->get();

        $posts = DB::table('posts')
            ->where('user_id', $client[0]->id)
            ->select('posts.*')
            ->orderByDesc('updated_at')
            ->paginate(10);

        return view('admin.clients.show',[
            'client' => $client,
            'posts' => $posts,
        ]);     

    }

    // the destriy function allow the the admins/mderators to deldte the clients. 
    // To do so, the function as to follow precie steps to avoid conflict with the db constraint. 
    // Step one retrieve and deletes the information related to the user on the client table
    // Step two gets all the posts made by the user ad delete them
    // Step three gets all the topics created by the user, deleted the posts from those topic and finalyl delete the said topics
    // Step for detach, of breaks the relatonship betwenn the user and its role to finnally delte the user (line 97)
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

    // Ban and unban manage the isBanned column on the clients table
    // isBanned expects either 0 or 1. Depending on whtehr is banned or not, some features are enabled

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
