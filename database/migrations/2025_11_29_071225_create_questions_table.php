<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //number -> <input type="number">
        //multiple_choice -> <select>
        //yes_no -> <input type="radio">
        //short_answer -> <input type="text">
        //long_answer -> <textarea>

        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->string('question_text');
            $table->enum(
                'question_type',
                [
                    'number',
                    'multiple_choice',
                    'yes_no',
                    'true_false',
                    'short_answer',
                    'long_answer'
                ]
            );
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
