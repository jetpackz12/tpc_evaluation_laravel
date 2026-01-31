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
        Schema::create('evaluations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id');
            $table->foreignId('teacher_id');
            $table->text('subject_id');
            $table->string('academic_year');
            $table->foreignId('semester_id');
            $table->foreignId('modality_id');
            $table->foreignId('category_id');
            $table->foreignId('question_id');
            $table->smallInteger('rate');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluations');
    }
};
