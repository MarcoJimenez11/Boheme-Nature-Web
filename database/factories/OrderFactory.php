<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $users = User::all()->pluck('id');

        return [
            'user_id' => fake()->randomElement($users),
            'province' => fake()->country(),
            'locality' => fake()->city(),
            'direction' => fake()->streetAddress(),
            'cost' => fake()->numberBetween(0,1000),
            'status' => 'Recibido',
        ];
    }
}
