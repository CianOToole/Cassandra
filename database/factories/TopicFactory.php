<?php

namespace Database\Factories;

use App\Models\Topic;
use Illuminate\Database\Eloquent\Factories\Factory;

class TopicFactory extends Factory{

    // there are 21 categories

    // there are 68 users atm

    protected $model = Topic::class;

    public function definition(){
        return [
            'title' => $this->faker->catchPhrase(),
            'original_post' => $this->faker->realText($maxNbChars = 200, $indexSize = 2),         
            'isPinned' => $this->pinned(),
            'number_of_replies' => $this->replies(),
            'user_id' => $this->userID(),
            'board_id' => $this->boardID(),
            'created_at' => $this->faker->dateTimeBetween('-1 week', '+1 week'),
        ];
    }

    private function pinned(){
        $i = rand(0,99);
        ($i < 99) ? $i = 0: $i = 1;
        return $i;
    }

    private function replies(){
        return $i = rand(1,35);
    }

    private function userID(){
        return $i = rand(1,65);
    }

    private function boardID(){
        return $i = rand(1,21);
    }

}
