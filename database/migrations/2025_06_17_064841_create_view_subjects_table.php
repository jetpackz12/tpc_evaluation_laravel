<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("
            CREATE VIEW view_subjects AS SELECT a.id, a.subject_code, a.subject_name, b.description AS semester, c.description AS year_level, d.program_code, d.program_name, a.status FROM subjects AS a
            INNER JOIN semesters AS b ON a.semester_id = b.id
            INNER JOIN year_levels AS c ON a.year_level_id = c.id
            INNER JOIN programs AS d ON a.program_id = d.id 
            ORDER BY a.id DESC 
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS view_subjects");
    }
};
