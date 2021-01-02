<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Hash;
use Storage;
use App\Models\User;
use App\Models\Role;
use App\Models\Client;
use App\Models\Employee;
use App\Models\Board;
use App\Models\Topic;
use App\Models\Post;
use Illuminate\Support\Arr;
Use Auth;

class TopicController extends Controller{

    public function index($id){

        $board = Board::where('id', '=', $id)->firstOrFail();

        $topics = DB::table('topics')
            ->where('board_id', $id)
            ->orderByDesc('updated_at')
            ->join('users', 'topics.user_id', '=', 'users.id')
            ->select('users.surname', 'topics.*')
            ->paginate(10);

        $posts = DB::table('topics')
            ->where('board_id', $id)
            ->join('posts', 'topics.user_id', '=', 'posts.topic_id')
            ->select('posts.topic_id')
            ->get();

        return view('topics.index',[
            'topics' => $topics,
            'board' => $board,
            'posts' => $posts,
        ]);
    }


    public function create($id){
        $board = Board::where('id', '=', $id)->firstOrFail();
        return view('topics.create',[
            'board' => $board,
        ]);
    }


    public function store(Request $request, $id){
        $request->validate([
            'title' => ['required', 'string', 'max:50'],
            'original_post' => ['required']
        ]);

        $user = Auth::user();

        $topic= new Topic();
        $topic->title = $request->input('title');
        $topic->original_post = $request->input('original_post');
        $topic->isPinned = 0;
        $topic->user_id = $user->id;
        $topic->board_id = $id;
        $topic->save();

        $request->session()->flash('success', 'Topic added successfully!');

        return redirect()->route('board.topics.index', $id);         
    }


    public function show($id){
        
    }


    public function edit($board_id, $topic_id){
        $board = Board::where('id', $board_id)->firstOrFail();
        $topic = Topic::where('id', $topic_id)->firstOrFail();
        
        return view('topics.edit',[
            'board' => $board,
            'topic' => $topic,
        ]);
    }


    public function update(Request $request, $board_id, $topic_id){
        $request->validate([
            'title' => ['required', 'string', 'max:50']
        ]);
        
        $topic = Topic::findOrFail($topic_id);
        $topic->title = $request->input('title');
        $topic->save();

        $request->session()->flash('info', 'Topic edited successfully!');
        return redirect()->route('board.topics.index', $board_id);
    }


    public function destroy(Request $request, $board_id, $topic_id){

        $topic = Topic::where('id', $topic_id)->firstOrFail();
        $posts = Post::where('topic_id', '=', $topic_id)->get();

        foreach($posts as $post){
            $post->delete();
        }        

        $topic->delete();


        $request->session()->flash('danger', 'Board removed successfully!');
        return redirect()->route('board.topics.index', $board_id); 
    }
}
