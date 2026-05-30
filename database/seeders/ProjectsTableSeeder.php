<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectsTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('projects')->insert([
            [
                'title' => 'تطبيق تجارة إلكترونية',
                'description' => 'منصة تسوق متكاملة مع لوحة تحكم ومزامنة الدفع',
                'image' => null,
                'url' => '#',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'نظام إدارة مهام',
                'description' => 'تطبيق ويب لتنظيم فرق العمل والمهام',
                'image' => null,
                'url' => '#',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
