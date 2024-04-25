<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $category = Category::pluck('id')->toArray();
        return [
            'name' => fake()->name(),
            'description' => fake()->text(),
            'price'=>fake()->numberBetween(100, 1000),
            'category_id'=> fake()->randomElement($category),
        ];
    }
}
