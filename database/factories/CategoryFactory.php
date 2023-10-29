<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{

    // protected $model = category::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->sentence(2) ,
            'description' => fake()->paragraph(2) ,
            // 'thumbnail' => 'storage/test/product-'.random_int(1,10).'.jpg'
        ];
    }
}
