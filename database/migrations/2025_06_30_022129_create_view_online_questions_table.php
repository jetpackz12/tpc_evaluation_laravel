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
            CREATE VIEW view_online_questions AS SELECT a.id, a.category_id, b.category_name, a.modality_id, c.modality, a.question, a.status FROM online_questions AS a
            INNER JOIN categories AS b ON a.category_id = b.id
            INNER JOIN modalities AS c ON a.modality_id = c.id 
            ORDER BY id DESC ;
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS view_online_questions");
    }
};
