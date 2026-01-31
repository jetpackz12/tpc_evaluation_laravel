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
            CREATE VIEW `view_teachers` AS SELECT a.id, a.id_num, b.id AS program_id, b.program_code, b.program_name, a.lastname, a.firstname, a.middlename, a.status 
            FROM teachers AS a
            INNER JOIN programs AS b ON a.program_id = b.id
            ORDER BY a.id DESC;
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS view_teachers");
    }
};
