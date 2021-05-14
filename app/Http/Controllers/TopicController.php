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
use App\Models\Balance;
use Illuminate\Support\Arr;
Use Auth;

class TopicController extends Controller{

    // Search work similarly to index, but retrieves only one post
    public function search($id){
        $board = Board::where('id', '=', $id)->firstOrFail();
        $search_text = $_GET['query'];
        
        $topic = Topic::where('title', 'LIKE', '%' . $search_text . '%')
            ->orderByDesc('isPinned')
            ->orderBy('updated_at')
            ->join('users', 'topics.user_id', '=', 'users.id')  
            ->select('users.id as op_id','users.surname as op_surname', 'users.avatar as op_avatar', 'users.email as op_email', 'topics.*')
            ->join('posts', 'topics.id', '=', 'posts.topic_id')     
            ->selectRaw('count(posts.topic_id) as replies')
            ->groupBy('id')
            ->distinct()
            ->paginate(8);

        $admins = DB::table('users')
            ->join('user_role', 'users.id', '=', 'user_role.user_id')
            ->select('users.id', 'users.surname', 'users.email', 'users.avatar')       
            ->where('role_id', 1)
            ->get();

        $moderators = DB::table('users')
            ->join('user_role', 'users.id', '=', 'user_role.user_id')
            ->select('users.id', 'users.surname', 'users.email', 'users.avatar')        
            ->where('role_id', 2)
            ->get();

        try {
            $user = Auth::user();
            $isBanned = DB::table('clients')
                ->select('clients.isBanned as banned')          
                ->where('user_id', $user->id)
                ->get();
                
            // dd($isBanned[0]);
        } catch (Exception $e) {
            echo($e);
        }

        $balance = Balance::where('user_id', Auth::id())->get();
        
        if ($balance[0]->amount >  0) {
            return view('topics.topic',[
                'board' => $board,
                'topic' => $topic,
                'admins' => $admins,
                'moderators' => $moderators,
                'isBanned' => $isBanned,
                'balance' => $balance[0],
            ]);
        } else {
            $balance = new Balance;
            $balance->type_of_currency = "Euro";
            $balance->amount = 100000.0;
            $balance->user_id = Auth::id();
            $balance->save();
        }
        $balance = Balance::where('user_id', Auth::id())->count();

        return view('topics.topic',[
            'board' => $board,
            'topic' => $topic,
            'admins' => $admins,
            'moderators' => $moderators,
            'isBanned' => $isBanned,
            'balance' => $balance,
        ]);
    }

    // Index get all the topics of a matching board
    // line 107 calculates the umber of posts related to the topic, so that if a topic is deemed as trendy, its title on the board's page is colored in red
    // the functon also retrieves the admins and moderators to be displayed on the forum managment box & the balandce of the user for the wallet box
    // Finally, index checks if the clients are banned. That information is imprtant to restrict access to the banned users certain features of the forum
    public function index($id){

        $board = Board::where('id', '=', $id)->firstOrFail();        

        $topics = DB::table('topics')
            ->where('board_id', $id)       
            ->orderByDesc('isPinned')
            ->orderBy('updated_at')
            ->join('users', 'topics.user_id', '=', 'users.id')       
            ->select('users.id as op_id','users.surname as op_surname', 'users.avatar as op_avatar', 'users.email as op_email', 'topics.*')
            ->join('posts', 'topics.id', '=', 'posts.topic_id')  
            ->selectRaw('count(posts.topic_id) as replies')
            ->groupBy('id')
            ->distinct()
            ->paginate(8);


        $admins = DB::table('users')
            ->join('user_role', 'users.id', '=', 'user_role.user_id')
            ->select('users.id', 'users.surname', 'users.email', 'users.avatar')    
            ->where('role_id', 1)
            ->get();

        $moderators = DB::table('users')
            ->join('user_role', 'users.id', '=', 'user_role.user_id')
            ->select('users.id', 'users.surname', 'users.email', 'users.avatar')          
            ->where('role_id', 2)
            ->get();

        
        try {
            $user = Auth::user();
            $isBanned = DB::table('clients')
                ->select('clients.isBanned as banned')          
                ->where('user_id', $user->id)
                ->get();
                
            // dd($isBanned[0]);
        } catch (Exception $e) {
            echo($e);
        }

        $balance = Balance::where('user_id', Auth::id())->get();
        
            if ($balance[0]->amount >  0) {
                return view('topics.index',[
                    'topics' => $topics,
                    'board' => $board,
                    'admins' => $admins,
                    'moderators' => $moderators,
                    'isBanned' => $isBanned,
                    'balance' => $balance[0],
                ]);
            } else {
                $balance = new Balance;
                $balance->type_of_currency = "Euro";
                $balance->amount = 100000.0;
                $balance->user_id = Auth::id();
                $balance->save();
            }
            $balance = Balance::where('user_id', Auth::id())->count();


        return view('topics.index',[
            'topics' => $topics,
            'board' => $board,
            'admins' => $admins,
            'moderators' => $moderators,
            'isBanned' => $isBanned,
            'balance' => $balance,
        ]);
    }

    // Store stores a new topc. A topic holds the poster's id, the board id it belongs to, a title and stores a post, the original one
    // the post also precise that it isn't pinned (see pin and unpin function below)
    public function store(Request $request, $id){
        $request->validate([
            'title' => ['required', 'string'],
            'post' => ['required', 'string'],
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

    // The destroy function deletes all the post related to the topic before deleting the topic itself
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

    // pin and upin are two function that deal only with the isPinned column of the Topics table
    // If a topic is pinned, then it will be pushed to the top of the board page. Otherwise, the order by which a topic appears on the board page is determined by its creation date.
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
