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

class ForumController extends Controller{

    public function boards_index(){
        $boards = DB::table('boards')->get();

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

        return view('forum.index',[
            'boards' => $boards,
            'admins' => $admins,
            'moderators' => $moderators,
        ]);
    }

    public function create() {

    }

    public function store(Request $request){
        
    }

    public function show($id) {
        
    }

    public function edit($id) {
        
    }

    public function update(Request $request, $id) {
        
    }

    public function destroy($id) {
        
    }
}
