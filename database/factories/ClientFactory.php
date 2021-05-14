<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientFactory extends Factory
{

    // The client factory makes n number of client determined in UserSeeder.
    // Each client is given client properties either by the faker library, or exp & ban function.
    // the latters determine randomly if a user is experieced and banned (those attributes have effect on the blade pages, such as colouring the posts avatars to highlight a user experience)
    protected $model = Client::class;

    public function definition(){
        $gender = $this->faker->randomElement(['male', 'female']);

        return [
            'name' => $this->faker->firstName($gender),
            'middle_name' => $this->faker->firstName($gender),         
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
