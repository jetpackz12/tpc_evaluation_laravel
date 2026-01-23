<?php

namespace Database\Seeders;

use App\Models\Program;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         Program::create([
            'program_code' => '1001',
            'program_name' => 'BAEL',
            'status' => '1',
        ]);

         Program::create([
            'program_code' => '1002',
            'program_name' => 'BSIS',
            'status' => '1',
        ]);

         Program::create([
            'program_code' => '1003',
            'program_name' => 'BSA',
            'status' => '1',
        ]);

         Program::create([
            'program_code' => '1004',
            'program_name' => 'BSAIS',
            'status' => '1',
        ]);

         Program::create([
            'program_code' => '1005',
            'program_name' => 'BECED',
            'status' => '1',
        ]);

         Program::create([
            'program_code' => '1006',
            'program_name' => 'BSCRIM',
            'status' => '1',
        ]);
    }
}
