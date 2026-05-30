<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NotificationsTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('notifications')->insert([
            ['user_id' => null, 'title' => 'مرحباً!', 'body' => 'تم تفعيل الحساب بنجاح', 'is_read' => false, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
