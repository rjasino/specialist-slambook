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
        User::factory()->create([
            'name' => 'Rob Admin',
            'email' => 'arohbi@gmail.com',
            'is_owner' => true,
        ]);

        User::factory(9)->create(); // regular users

        $this->call([
            SectionSeeder::class,
            QuestionSeeder::class,
        ]);
    }
}
