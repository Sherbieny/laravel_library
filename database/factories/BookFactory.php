<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    protected $model = Book::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'author' => $this->faker->name,
            'description' => $this->faker->paragraph,
            'publication_year' => $this->faker->year,
            'cover_image' => $this->faker->imageUrl,
            'category_id' => Category::factory(),
            'user_id' => User::factory(),
        ];
    }
}
