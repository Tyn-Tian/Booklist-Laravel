<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Book::create([
            "id" => "1",
            "book" => "Belajar PHP Dasar"
        ]);
        Book::create([
            "id" => "2",
            "book" => "Belajar Laravel Dasar"
        ]);
    }
}
