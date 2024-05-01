<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Run the groupSeeder
        $this->call(GroupSeeder::class);
        $this->call(Priorities::class);
        $this->call(Categories::class);
        $this->call(SettingsSeeder::class);

        // Create a user
        User::factory()->create([
            'name' => 'John Doe',
            'email' => 'sebastienmerveilleriviere@gmail.com',
            'group_id' => 1, // 'admin
            'password' => bcrypt('password'),
        ]);
    }
}
