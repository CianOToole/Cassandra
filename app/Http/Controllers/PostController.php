<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Hash;
use Storage;
Use Auth;
Use App\Models\Post;

class PostController extends Controller
{

    public function index($topic_id){
        $topic_id = $topic_id;
        $topic_title = DB::table('topics')
            ->where('id', $topic_id)
            ->pluck('title');

        $posts = DB::table('posts')
            ->where('topic_id', $topic_id)
            ->join('users', 'posts.user_id', '=', 'users.id')    
            ->leftJoin('employees', 'users.id', '=', 'employees.user_id')                   
            ->leftJoin('clients', 'users.id', '=', 'clients.user_id')
            ->select('posts.*', 'users.surname', 'users.avatar',  'employees.name as emp_name', 'clients.name as clt_name') 
            ->orderBy('updated_at')
            ->paginate(10);

        $admins = DB::table('users')
            ->join('user_role', 'users.id', '=', 'user_role.user_id')
            ->select('users.id', 'users.surname')        
            ->where('role_id', 1)
            ->get();

        $moderators = DB::table('users')
            ->join('user_role', 'users.id', '=', 'user_role.user_id')
            ->select('users.id', 'users.surname')        
            ->where('role_id', 2)
            ->get();

        return view('posts.index',[
            'posts' => $posts,
            'topic_title' => $topic_title,
            'topic_id' => $topic_id,
            'admins' => $admins,
            'moderators' => $moderators,
        ]);
    }

    public function store(Request $request, $topic_id){

        $request->validate([
            'post' => ['required'],
        ]);

        $user = Auth::user();

        $post= new Post();
        $post->post = $request->input('post');
        $post->user_id = $user->id;
        $post->topic_id = $topic_id;
        echo($topic_id);    
        $post->save();

        $request->session()->flash('success', 'Post added successfully!');

        return redirect()->route('topic.posts.index', $topic_id);      

    }



    public function edit($id){

    }


    public function update(Request $request, $topic_id, $post_id){
        $request->validate([
            'post' => ['required']
        ]);
        
        $post = Post::findOrFail($post_id);
        $post->post = $request->input('post');
        $post->save();

        $request->session()->flash('info', 'Post edited successfully!');
        return redirect()->route('topic.posts.index', $topic_id);
    }


    public function destroy(Request $request, $topic_id, $post_id){
        $post = Post::where('id', $post_id)->firstOrFail();
        $post->delete();


        $request->session()->flash('danger', 'Post removed successfully!');
        return redirect()->route('topic.posts.index', $topic_id); 
    }
}
