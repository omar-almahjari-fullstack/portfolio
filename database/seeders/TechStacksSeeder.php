<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TechStacksSeeder extends Seeder
{
    public function run(): void
    {
        $techs = [
            ['name' => 'Flutter', 'icon' => 'fab fa-flutter', 'sort' => 1],
            ['name' => 'Laravel', 'icon' => 'fab fa-laravel', 'sort' => 2],
            ['name' => 'C#', 'icon' => 'fas fa-code', 'sort' => 3],
            ['name' => 'Firebase', 'icon' => 'fas fa-fire', 'sort' => 4],
            ['name' => 'MySQL', 'icon' => 'fas fa-database', 'sort' => 5],
        ];

        foreach ($techs as $tech) {
            DB::table('tech_stacks')->insert([
                'name' => $tech['name'],
                'icon' => $tech['icon'],
                'sort' => $tech['sort'],
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
