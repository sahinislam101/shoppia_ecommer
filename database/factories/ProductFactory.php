<?php

namespace Database\Factories;

use App\Models\Sub;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Support\Str;
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
        $name = $this->faker->unique()->words(3, true);

        return [
            'id' => Str::uuid(),
            'name' => ucfirst($name),
            'slug' => Str::slug($name),
            'category_id' => Category::inRandomOrder()->value('id'),
            'sub_id' => Sub::inRandomOrder()->value('id'),
            'brand_id' => Brand::inRandomOrder()->value('id'),
            'small_description' => $this->faker->sentence(8),
            'description' => $this->faker->paragraph(),
            'original_price' => $this->faker->randomFloat(2, 100, 1000),
            'selling_price' => $this->faker->randomFloat(2, 80, 900),
            'stock' => $this->faker->numberBetween(0, 100),
            'image' => 'products/default.png', // or use faker image
            'flash_sales' => $this->faker->boolean(20),
            'best_sell' => $this->faker->boolean(20),
            'explore' => $this->faker->boolean(20),
            'status' => true,
        ];
    }
}
