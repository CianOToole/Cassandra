<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Hash;
use Storage;
Use Auth;
use App\Models\Balance;
use App\Models\Trade;
use App\Services\UserBalanceService;
use App\Services\TradeService;
Use App\Models\Post;

class PostController extends Controller
{
// PossControllers holds all the logic behind posts interaction

// Index get all the posts of a matching topic from its original poster name/surname, avatar and role
// lines 31 & 32 use leftJoin since some data is shares among the clients and employees, while other can be ignored
// the functon also retrieves the admins and moderators to be displayed on the forum managment box & the balandce of the user for the wallet box
// Finally, index checks if the clients are banned. That information is imprtant to restrict access to the banned users certain features of the forum
    public function index($topic_id){
        $balances = Balance::where('user_id', Auth::id())->get();
        $trades = Trade::where('user_id', '=', Auth::id())->where('tradeClosed', '=', false)->get();
        $gainLoss = (new TradeService())->calProfitLoss();
        $portfolioCash = 0;
        foreach ($trades as $trade) {
            $portfolioCash = $trade->amount;
        }
        $portfolioCash += $gainLoss;


        $topic_id = $topic_id;
        $topic = DB::table('topics')
            ->select('topics.board_id', 'topics.title')        
            ->where('id', $topic_id)
            ->get();

        $posts = DB::table('posts')
            ->where('topic_id', $topic_id)
            ->join('users', 'posts.user_id', '=', 'users.id') 
            ->join('user_role', 'users.id', '=', 'user_role.user_id')   
            ->join('roles', 'user_role.role_id', '=', 'roles.id')   
            ->leftJoin('employees', 'users.id', '=', 'employees.user_id')                   
            ->leftJoin('clients', 'users.id', '=', 'clients.user_id')
            ->select('posts.*', 'users.surname', 'users.avatar',  'employees.name as emp_name', 'clients.name as clt_name', 'clients.isExperienced as experience', 'roles.id as role')
            ->orderBy('updated_at')
            ->paginate(10);

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

        $balance = Balance::where('user_id', Auth::id())->get();
        
            if ($balances[0]->amount >  0) {
                return view('posts.index',[
                    'posts' => $posts,
                    'topic' => $topic,
                    'topic_id' => $topic_id,
                    'admins' => $admins,
                    'moderators' => $moderators,
                    'isBanned' => $isBanned,
                    'trades' => $trades,
                    'balances' => $balances,
                    'gainLoss' => $gainLoss,
                    'portfolioCash' => $portfolioCash
                ]);
            } else {
                $balance = new Balance;
                $balance->type_of_currency = "Euro";
                $balance->amount = 100000.0;
                $balance->user_id = Auth::id();
                $balance->save();
            }
          

        return view('posts.index',[
            'posts' => $posts,
            'topic' => $topic,
            'topic_id' => $topic_id,
            'admins' => $admins,
            'moderators' => $moderators,
            'isBanned' => $isBanned,
            'trades' => $trades,
            'balances' => $balances,
            'gainLoss' => $gainLoss,
            'portfolioCash' => $portfolioCash
        ]);
    }

    // Store saves a new post. A post is made of the posting user's id, topic id and the post itself
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

    // Update allows the user to update their post
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

// While destroy enable deletion for the post's author
    public function destroy(Request $request, $topic_id, $post_id){
        $post = Post::where('id', $post_id)->firstOrFail();
        $post->delete();


        $request->session()->flash('danger', 'Post removed successfully!');
        return redirect()->route('topic.posts.index', $topic_id); 
    }
}
