<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Author;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
     public function run(): void
    {
        for ($i=0; $i<50; $i++) {
            $authorId = Author::inRandomOrder()->first()->id;
            Book::factory()->create(['author_id' => $authorId]);
        }   
    }
}
