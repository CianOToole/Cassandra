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

    public function search($id){
        $board = Board::where('id', '=', $id)->firstOrFail();
        $search_text = $_GET['query'];
        $topic = Topic::where('title', 'LIKE', '%' . $search_text . '%')
            ->join('users', 'topics.user_id', '=', 'users.id')            
            ->join('posts', 'topics.user_id', '=', 'posts.topic_id')     
            ->select('users.surname', 'topics.*', DB::raw("COUNT('posts.topic_id') as replies")) 
            ->groupBy('id')
            ->distinct()
            ->get();

        return view('topics.topic',[
            'board' => $board,
            'topic' => $topic,
        ]);
    }

    public function index($id){

        $board = Board::where('id', '=', $id)->firstOrFail();

        $topics = DB::table('topics')
            ->where('board_id', $id)       
            ->orderByDesc('isPinned')
            ->orderByDesc('updated_at')
            ->join('users', 'topics.user_id', '=', 'users.id')       
            ->select('users.surname', 'topics.*')
            ->join('posts', 'topics.id', '=', 'posts.topic_id')  
            ->selectRaw('count(posts.topic_id) as replies')
            ->groupBy('id')
            ->distinct()
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

        return view('topics.index',[
            'topics' => $topics,
            'board' => $board,
            'admins' => $admins,
            'moderators' => $moderators,
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
            'post' => ['required', 'string', 'min:10'],
        ]);

        $user = Auth::user();

        $topic= new Topic();
        $topic->title = $request->input('title');
        $topic->isPinned = 0;
        $topic->user_id = $user->id;
        $topic->board_id = $id;        
        $topic->save();

        $post= new Post();
        $post->post = $request->input('post');
        $post->user_id = $user->id;
        $post->topic_id = $topic->id;
        $post->save();

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

    public function profile($id, $board_id){
        $user = User::where('id', '=', $id)->get();
        $board = Board::where('id', '=', $board_id)->get();

        $role =$user;
        $role->load(['employee', 'client']);

        return view('topics.profile',[
            'user' => $user,
            'board' => $board
        ]);
    
    }

    public function pin(Request $request, $board_id, $topic_id){
        $request->validate([
            'isPinned' => ['required']
        ]);

        $topic = Topic::findOrFail($topic_id);
        $topic->isPinned = $request->input('isPinned');
        $topic->save();

        $request->session()->flash('info', 'Topic pinned successfully!');
        return redirect()->route('board.topics.index', $board_id);
    
    }

    public function unpin(Request $request, $board_id, $topic_id){
        $request->validate([
            'isPinned' => ['required']
        ]);

        $topic = Topic::findOrFail($topic_id);
        $topic->isPinned = $request->input('isPinned');
        $topic->save();

        $request->session()->flash('info', 'Topic unpinned successfully!');
        return redirect()->route('board.topics.index', $board_id);
    
    }

}
