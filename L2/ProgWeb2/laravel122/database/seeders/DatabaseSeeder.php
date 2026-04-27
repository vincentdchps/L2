<?php

namespace Database\Seeders;

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
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'user@user.test',
        ]);

        $this->call([
            VideoSeeder::class,
            AuthorSeeder::class,
            BookSeeder::class,
        ]);

        \App\Models\User::factory()->create([
    'email' => 'admin@admin.test',
    'role' => 'admin',
]);

\App\Models\User::factory()->create([
    'email' => 'su@su.test',
    'role' => 'su',
]);

    }
}

