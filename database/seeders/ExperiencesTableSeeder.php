<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExperiencesTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('experiences')->insert([
            [
                'title' => 'مهندس برمجيات',
                'company' => 'شركة تقنية',
                'duration' => '2020 - الآن',
                'description' => 'تطوير حلول برمجية متكاملة',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
