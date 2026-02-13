<?php

namespace Database\Seeders;

use App\models\User ;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
     public function run(): void
    {
        User::factory()->create(['name' => 'user', 'email' => 'user@user.test', 'role' => 'user']);
        User::factory()->create(['name' => 'admin', 'email' => 'admin@admin.test', 'role' => 'admin']);
        User::factory()->create(['name' => 'su', 'email' => 'su@su.test', 'role' => 'su']);

        User::factory(10)->create();
    }
}
