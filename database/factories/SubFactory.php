<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sub>
 */
class SubFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->unique()->words(2, true);
        return [
            'id' => Str::uuid(),
            'name' => ucfirst($name),
            'slug' => Str::slug($name),
            'category_id' => Category::inRandomOrder()->value('id'),
            'description' => $this->faker->sentence(),
            'status' => $this->faker->boolean(90),
        ];
    }
}
