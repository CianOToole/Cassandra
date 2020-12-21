<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientFactory extends Factory
{

    protected $model = Client::class;

    public function definition(){
        $gender = $this->faker->randomElement(['male', 'female']);

        return [
            'name' => $this->faker->firstName($gender),
            'middle_name' => $this->faker->name($gender),         
            'DOB' => $this->faker->dateTimeBetween(),
            'gender' => $gender,
            'postcode' => $this->faker->postcode,
            'country' => 'Ireland',
            'isExperienced' => $this->exp(),
            'isBanned' => $this->ban(),
            'user_id' => 'user_id',
        ];
    }

    private function exp(){
        $i = rand(0,8);
        ($i < 7) ? $i = 0: $i = 1;
        return $i;
    }

    private function ban(){
        $i = rand(0,8);
        ($i < 8) ? $i = 0: $i = 1;
        return $i;
    }

}
