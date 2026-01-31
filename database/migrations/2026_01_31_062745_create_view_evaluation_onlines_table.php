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
        DB::statement("
            CREATE VIEW `view_evaluation_onlines` AS SELECT a.id, a.student_id, a.academic_year, CONCAT(b.last_name, ' ', b.first_name, ' ', b.middle_name) AS student_name, 
            sa.id AS program_id, sa.program_code, sa.program_name, sb.description AS year_level, sc.description AS student_status,
            sd.description AS account_status, c.id AS teacher_id, CONCAT(c.lastname, ' ', c.firstname, ' ', c.middlename) AS teacher_name,
            a.subject_id, e.id AS semester_id, e.description AS semester, f.modality, g.category_name, h.category_id, h.modality_id, h.id AS question_id, h.question, a.rate, a.created_at
            FROM evaluations AS a
            INNER JOIN students AS b ON a.student_id = b.id
            INNER JOIN programs AS sa ON b.program_id = sa.id
            INNER JOIN year_levels AS sb ON b.year_level_id = sb.id
            INNER JOIN student_statuses AS sc ON b.student_status_id = sc.id
            INNER JOIN account_statuses AS sd ON b.status = sd.id
            INNER JOIN teachers AS c ON a.teacher_id = c.id
            INNER JOIN semesters AS e ON a.semester_id = e.id
            INNER JOIN modalities AS f ON a.modality_id = f.id
            INNER JOIN categories AS g ON a.category_id = g.id
            INNER JOIN online_questions AS h ON a.question_id = h.id
            WHERE a.modality_id = 2
            ORDER BY a.id ;
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS view_evaluation_onlines");
    }
};
