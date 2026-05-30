<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AboutFeaturesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('about_features')->insert([
            [
                'about_id' => 1,
                'icon' => 'fas fa-mobile-alt',
                'title' => 'تطوير تطبيقات Flutter',
                'description' => 'بناء تطبيقات متعددة المنصات بأداء فائق',
                'sort' => 100,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'about_id' => 1,
                'icon' => 'fas fa-code',
                'title' => 'تطوير Laravel',
                'description' => 'إنشاء أنظمة ويب متكاملة وآمنة',
                'sort' => 200,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'about_id' => 1,
                'icon' => 'fas fa-database',
                'title' => 'حلول C#',
                'description' => 'تطوير تطبيقات سطح المكتب والمؤسسات',
                'sort' => 300,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
