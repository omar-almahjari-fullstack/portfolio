<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChatsTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('chats')->insert([
            ['user_id' => null, 'message' => 'مرحباً كيف أستطيع مساعدتك؟', 'is_read' => false, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
