<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
        return [
            'title' => fake()->title(),
            'slug' => fake()->unique()->slug(),
            'description' => fake()->text(),
            'price' => rand(10, 1000),
            'image_url' => Str::random(10).'.jpg',
            'file_path' => 'products/'.Str::random(10).'.zip',
            'rating' => rand(1, 5),
        ];
    }
}
