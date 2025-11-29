<?php

namespace Database\Seeders;

use App\Models\Question;
use App\Models\Section;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sections = Section::all();

        if ($sections->isEmpty()) {
            $this->command->error('No sections found. Please seed sections before seeding questions.');
            return;
        }

        // Load questions data from JSON file
        $jsonPath = database_path('seeders/questions_data.json');

        if (!file_exists($jsonPath)) {
            $this->command->error('questions_data.json file not found.');
            return;
        }

        $questionsData = json_decode(file_get_contents($jsonPath), true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            $this->command->error('Error parsing questions_data.json: ' . json_last_error_msg());
            return;
        }

        // Insert questions from JSON data
        foreach ($questionsData as $questionData) {
            $section = $sections->where('id', $questionData['section_id'])->first();
            Question::create([
                'section_id' => $section->id,
                'question_text' => $questionData['question_text'],
                'question_type' => $questionData['question_type'],
            ]);
        }

        $this->command->info('Questions seeded successfully from questions_data.json');
    }
}
