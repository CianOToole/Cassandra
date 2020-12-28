<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TopicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        DB::table('topics')->insert([
            'title' => 'Lorem Ipsum',
            'original_post' => 'consectetur adipiscing elit. Integer massa ligula, dapibus non malesuada id, suscipit ac elit. Nunc iaculis felis eros, et eleifend risus sollicitudin in.',
            'isPinned' => 0,
            'number_of_replies' => 0,
            'user_id' => 3,
            'board_id' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
