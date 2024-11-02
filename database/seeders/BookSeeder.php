<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\User;
use App\Models\Category;

class BookSeeder extends Seeder
{
    public function run()
    {
        $user = User::first(); // Use the first user created by UserSeeder
        $categories = Category::all();

        $books = [
            [
                'title' => 'The Great Gatsby',
                'author' => 'F. Scott Fitzgerald',
                'description' => 'A novel set in the Jazz Age.',
                'publication_year' => 1925,
                'category_id' => $categories->random()->id,
                'user_id' => $user->id,
            ],
            [
                'title' => 'To Kill a Mockingbird',
                'author' => 'Harper Lee',
                'description' => 'A novel about racial injustice.',
                'publication_year' => 1960,
                'category_id' => $categories->random()->id,
                'user_id' => $user->id,
            ],
            // Add more sample books here if needed
        ];

        foreach ($books as $book) {
            Book::create($book);
        }
    }
}
