<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Order;
use App\Models\Product;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderLine>
 */
class OrderLineFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $orders = Order::all()->pluck('id');
        $products = Product::all()->pluck('id');

        return [
            'order_id' => fake()->randomElement($orders),
            'product_id' => fake()->randomElement($products),
            'amount' => fake()->numberBetween(1,10),
        ];
    }
}
