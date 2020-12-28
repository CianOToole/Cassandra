<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Topic;
use App\Models\Post;

class TopicSeeder extends Seeder
{

    public function run(){

        $topics = Topic::factory()
            ->count(100)
            ->has(Post::factory()->count($i = mt_rand(1,4)))
            ->create();

    }
}
