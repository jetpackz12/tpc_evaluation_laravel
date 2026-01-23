<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    
    use WithoutModelEvents;
    
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            AccountStatusSeeder::class,
            StudentStatusSeeder::class,
            YearLevelSeeder::class,
            ProgramSeeder::class,
            SemesterSeeder::class,
            CategorySeeder::class,
            ModalitySeeder::class
        ]);
    }
}
