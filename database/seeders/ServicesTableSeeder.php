<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServicesTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('services')->insert([
            [
                'title' => 'تطوير تطبيقات موبايل',
                'description' => 'بناء تطبيقات Android و iOS باستخدام Flutter',
                'icon' => 'fa-mobile-alt',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'تطوير ويب',
                'description' => 'تطبيقات ويب مع Laravel و Vue/React',
                'icon' => 'fa-code',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
