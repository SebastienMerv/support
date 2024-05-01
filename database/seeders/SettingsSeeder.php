<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::create([
            'display_name' => 'Nombre de jour avant de cloturer un ticket',
            'name' => 'days_to_resolve',
            'value' => '7',
            'type' => 'number'
        ]);
    }
}
