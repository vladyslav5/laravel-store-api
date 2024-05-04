<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderProduct>
 */
class OrderProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $orders = Order::pluck('id')->toArray();
        $products = Product::pluck('id')->toArray();
        return [
            'amount' => fake()->numberBetween(10, 100),
            'order_id' => fake()->randomElement($orders),
            'product_id' => fake()->randomElement($products),
        ];
    }
}
