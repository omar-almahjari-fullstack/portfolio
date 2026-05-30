<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // create default user (avoid factory to prevent environment issues)
        \Illuminate\Support\Facades\DB::table('users')->insert([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // call new seeders
        $this->call([
            AboutSeeder::class,
            AboutFeaturesSeeder::class,
            ProjectsTableSeeder::class,
            ServicesTableSeeder::class,
            ExperiencesTableSeeder::class,
            // new skills seeder
            \Database\Seeders\SkillCategoriesSeeder::class,
            LinksTableSeeder::class,
            ChatsTableSeeder::class,
            NotificationsTableSeeder::class,
        ]);
    }
}
