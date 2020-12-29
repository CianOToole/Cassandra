<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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

class BoardController extends Controller{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin');  
    }

    public function index(){
        
    }

    public function create(){
        return view('admin.board.create');
    }

    public function store(Request $request){
        $request->validate([
            'category' => ['required', 'string', 'max:50']
        ]);

        $board = new Board();
        $board->category = $request->input('category');
        $board->save();

        $request->session()->flash('success', 'Board added successfully!');

        return redirect()->route('forum.index');
    }

    public function show($id){
        
    }

    public function edit($id){
        $board = DB::table('boards')        
            ->where('boards.id', $id)
            ->get();

        return view('admin.board.edit',[
            'board' => $board
        ]);

    }

    public function update(Request $request, $id){
        $request->validate([
            'category' => ['required', 'string', 'max:50']
        ]);

        $board = Board::findOrFail($id);
        $board->category = $request->input('category');
        $board->save();

        $request->session()->flash('info', 'Board edited successfully!');
        return redirect()->route('forum.index');
    }

    public function destroy(Request $request, $id){

        $board = Board::where('id', $id)->firstOrFail();

        $topics = Topic::where('board_id', '=', $id)->get();
        foreach($topics as $topic){
            $id = $topic->id;
            $posts = Post::where('topic_id', $id)->get();
            foreach($posts as $post){
                $post->delete();
            }
            $topic->delete();
        }        

        $board->delete();

        $request->session()->flash('danger', 'Board removed successfully!');
        return redirect()->route('forum.index');
    }
}
