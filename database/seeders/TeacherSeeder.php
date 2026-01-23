<?php

namespace Database\Seeders;

use App\Models\Teacher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Teacher::create([
            'id_num' => "0001",
            'program_id' => 1,
            'firstname' => "dummy",
            'middlename' => "dummy",
            'lastname' => "dummy",
            'status' => 1
        ]);
    }
}
