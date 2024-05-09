<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\Publisher;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Category::create([
            'name' => 'برمجة',
            'description' => 'قسم خاصة بالبرمجة',
            'slug' => 'programming'
        ]);
        Publisher::factory(2)
            ->has(Book::factory(6))
            ->create();
    }
}
