<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory{

    protected $model = Post::class;

    public function definition(){
        return [
            'post' => $this->faker->realText($maxNbChars = 200, $indexSize = 2),        
            'user_id' => $this->userID(),
            'topic_id' => $this->topicID(),
            'created_at' => $this->faker->dateTimeBetween('-1 week', '+1 week'),
        ];
    }

    private function userID(){
        return $i = rand(1,65);
    }
    
    private function topicID(){
        return $i = rand(1,21);
    }

}


