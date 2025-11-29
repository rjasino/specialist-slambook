<?php

namespace Database\Seeders;

use App\Models\Section;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Section::create([
            'section_name' => 'Personal Info',
            'description' => 'Basic personal information about the individual.'
        ]);
        Section::create([
            'section_name' => 'Favorites',
            'description' => 'Questions about favorite things like food, color, movie, etc.'
        ]);
        Section::create([
            'section_name' => 'This or That',
            'description' => 'A series of binary choice questions to understand preferences.'
        ]);
    }
}
