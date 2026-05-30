<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SkillCategoriesSeeder extends Seeder
{
    public function run()
    {
        // ------------------------------
        // 1) إدخال الفئات (Categories)
        // ------------------------------

        $categories = [
            ['title' => 'تطوير تطبيقات الجوال', 'sort' => 1],
            ['title' => 'تطوير الواجهات الخلفية', 'sort' => 2],
            ['title' => 'تطوير الواجهات الأمامية', 'sort' => 3],
        ];

        DB::table('skill_categories')->insert($categories);

        // جلب الفئات بعد الإدخال لمعرفة الـ id
        $cats = DB::table('skill_categories')->orderBy('sort')->get();

        // ------------------------------
        // 2) إدخال المهارات (Items)
        // ------------------------------

        $allItems = [

            // تطوير تطبيقات الجوال
            [
                'category' => 'تطوير تطبيقات الجوال',
                'items' => [
                    ['name' => 'Flutter/Dart', 'level' => '93', 'sort' => 1],
                    ['name' => 'Firebase', 'level' => '85', 'sort' => 2],
                    ['name' => 'C#/.NET', 'level' => '87', 'sort' => 3],
                ]
            ],

            // تطوير الواجهات الخلفية
            [
                'category' => 'تطوير الواجهات الخلفية',
                'items' => [
                    ['name' => 'PHP/Laravel', 'level' => '92', 'sort' => 1],
                    ['name' => 'MySQL/PostgreSQL', 'level' => '88', 'sort' => 2],
                    ['name' => 'REST APIs', 'level' => '90', 'sort' => 3],
                ]
            ],

            // تطوير الواجهات الأمامية
            [
                'category' => 'تطوير الواجهات الأمامية',
                'items' => [
                    ['name' => 'HTML/CSS', 'level' => '95', 'sort' => 1],
                    ['name' => 'JavaScript', 'level' => '90', 'sort' => 2],
                    ['name' => 'React/Vue', 'level' => '85', 'sort' => 3],
                ]
            ],
        ];

        // إدخال العناصر وربطها بالـ category_id الصحيح
        foreach ($allItems as $block) {
            $cat = $cats->firstWhere('title', $block['category']);

            foreach ($block['items'] as $item) {
                DB::table('skill_items')->insert([
                    'category_id' => $cat->id,
                    'name'        => $item['name'],
                    'level'       => $item['level'],
                    'sort'        => $item['sort'],
                    'created_at'  => now(),
                    'updated_at'  => now(),
                ]);
            }
        }
    }
}
