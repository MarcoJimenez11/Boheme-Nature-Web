<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::factory()->create([
            'name' => 'Jabones'
        ]);

        Category::factory()->create([
            'name' => 'Velas'
        ]);

        Category::factory()->create([
            'name' => 'Sales de baño'
        ]);

        Category::factory()->create([
            'name' => 'Bombas de baño'
        ]);
    }
}
