<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Hash;
use Storage;
Use Auth;

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
            ->join('clients', 'users.id', '=', 'clients.user_id')
            ->select('posts.*', 'users.surname', 'users.avatar', 'clients.name')
            ->orderByDesc('updated_at')
            ->get();

        return view('posts.index',[
            'posts' => $posts,
            'topic_title' => $topic_title,
            'topic_id' => $topic_id,
        ]);
    }


    public function create(){
        
    }


    public function store(Request $request){
        
    }


    public function show($id){
        
    }


    public function edit($id){
        
    }


    public function update(Request $request, $id){
        
    }


    public function destroy($id){
        
    }
}
