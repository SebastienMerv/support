<?php

namespace Database\Seeders;

use App\Models\Priority;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Priorities extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Priority::create([
            'name' => 'Low',
            'level' => 1,
            'color' => 'green',
        ]);

        Priority::create([
            'name' => 'Normal',
            'level' => 2,
            'color' => 'blue',
        ]);

        Priority::create([
            'name' => 'High',
            'level' => 3,
            'color' => 'red',
        ]);

        Priority::create([
            'name' => 'Critical',
            'level' => 4,
            'color' => 'black',
        ]);
    }
}
