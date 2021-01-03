<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Topic;
use App\Models\Post;

class TopicSeeder extends Seeder
{

    public function run(){

        for($i = 1; $i <=100 ; $i++){
            Topic::factory()->hasPosts(mt_rand(1,15))->create();
        }

    }
}
