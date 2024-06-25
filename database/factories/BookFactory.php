<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->name(),
            'category_id' => Category::get()[0]->id,
            'isbn' => $this->faker->unique()->isbn13(),
            'description' => $this->faker->realText(),
            'date_publish' => $this->faker->date(),
            'pages' => $this->faker->randomDigit(),
            'copies' => $this->faker->randomDigit(),
            'price' => $this->faker->randomDigit(),
            'thumbnail' => $this->faker->imageUrl(),
        ];
    }
}
