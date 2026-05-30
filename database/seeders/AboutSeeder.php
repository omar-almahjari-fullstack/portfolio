<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AboutSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('abouts')->insert([
            ['name' => 'عمر المحجري', 'bio' => 'مطور Full-Stack', 'description' => 'أعمل على بناء تطبيقات عالية الجودة باستخدام Flutter و Laravel و C#.', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
