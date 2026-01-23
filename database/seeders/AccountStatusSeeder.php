<?php

namespace Database\Seeders;

use App\Models\AccountStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AccountStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         AccountStatus::create([
            'description' => 'approved',
        ]);
        
        AccountStatus::create([
            'description' => 'pending',
        ]);

        AccountStatus::create([
            'description' => 'cancelled',
        ]);
    }
}
