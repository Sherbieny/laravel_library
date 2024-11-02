<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            ['name' => 'Fiction'],
            ['name' => 'Non-Fiction'],
            ['name' => 'Science Fiction'],
            ['name' => 'Biography'],
            ['name' => 'History'],
            ['name' => 'Fantasy'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
