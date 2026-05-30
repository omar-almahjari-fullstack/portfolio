<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LinksTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('links')->insert([
            ['title' => 'GitHub', 'url' => 'https://github.com', 'icon' => 'fab fa-github', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'LinkedIn', 'url' => 'https://linkedin.com', 'icon' => 'fab fa-linkedin', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
