<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // the user factory create fake data for each new users created when seedng the database
        return [
            'surname' => $this->faker->lastName,
            'email' => $this->faker->unique()->safeEmail,
            'phone' =>  0 . rand(85, 89) . "-" . rand(1111, 9999) . "-" . rand(111, 999),
            'address' => $this->faker->streetAddress,
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi' // password
        ];
    }
}
