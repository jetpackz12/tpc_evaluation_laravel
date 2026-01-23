<?php

namespace Database\Seeders;

use App\Models\StudentStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         StudentStatus::create([
            'description' => 'Regular Student',
        ]);
        
        StudentStatus::create([
            'description' => 'Irregular Student',
        ]);
    }
}
