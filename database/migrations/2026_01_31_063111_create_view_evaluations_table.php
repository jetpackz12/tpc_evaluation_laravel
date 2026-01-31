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
            CREATE VIEW `view_evaluations` AS SELECT * FROM view_evaluation_face_to_faces
            UNION ALL
            SELECT * FROM view_evaluation_onlines
            ORDER BY id ;
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('view_evaluations');
    }
};
