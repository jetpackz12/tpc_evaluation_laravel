<?php

namespace Database\Seeders;

use App\Models\YearLevel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class YearLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         YearLevel::create([
            'description' => 'First Year',
        ]);
        
        YearLevel::create([
            'description' => 'Second Year',
        ]);
        
        YearLevel::create([
            'description' => 'Third Year',
        ]);
        
        YearLevel::create([
            'description' => 'Fourth Year',
        ]);
    }
}
