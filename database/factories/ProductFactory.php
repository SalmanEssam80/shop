<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->sentence(2),
            'weight' => random_int(20,200),
            'price' => random_int(100,2000),
            'stock' => random_int(5,20),
            'category_id' => random_int(1,4),
            'description' => fake()->paragraph(),
            'image' => 'storage/test/product-'.random_int(1,10).'.jpg',
            'thumbnail' => 'storage/test/product-'.random_int(1,10).'.jpg'
        ];
    }
}
