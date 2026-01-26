<?php

namespace Database\Seeders;

use App\Models\student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        student::create([
            'last_name' => "dummy",
            'first_name' => "dummy",
            'middle_name' => "dummy",
            'program_id' => 1,
            'year_level_id' => 1,
            'student_status_id' => 1,
            'student_identification' => "xxxxxx",
            'password' => Hash::make("123456"),
            'status' => 1
        ]);
    }
}
