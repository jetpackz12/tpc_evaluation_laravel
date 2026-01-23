<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'category_name' => 'Classroom Managements',
            'status' => '1'
        ]);
        
        Category::create([
            'category_name' => 'Interaction and Engagement',
            'status' => '1'
        ]);
        
        Category::create([
            'category_name' => 'Communication',
            'status' => '1'
        ]);
        
        Category::create([
            'category_name' => 'Course Design and Technology',
            'status' => '1'
        ]);
        
        Category::create([
            'category_name' => 'Assessment and Feedback',
            'status' => '1'
        ]);
        
        Category::create([
            'category_name' => 'Engagement and Interactivity',
            'status' => '1'
        ]);
    }
}
