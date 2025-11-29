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
        Schema::table('slambooks', function (Blueprint $table) {
            $table->dropColumn([
                'age',
                'zodiac_sign',
                'in_relationship',
                'dream_job',
                'motto',
                'three_words'
            ]);
            $table->foreignId('question_id')->after('id')->constrained()->onDelete('cascade');
            $table->text('response')->after('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('slambooks', function (Blueprint $table) {
            $table->dropForeign(['question_id']);
            $table->dropColumn(['question_id', 'response']);
            $table->integer('age')->after('user_id');
            $table->string('zodiac_sign')->after('age');
            $table->boolean('in_relationship')->after('zodiac_sign');
            $table->string('dream_job')->after('in_relationship');
            $table->string('motto')->after('dream_job');
            $table->string('three_words')->after('motto');
        });
    }
};
