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
            'name' => 'Bebida'
        ]);

        Category::factory()->create([
            'name' => 'Congelados'
        ]);

        Category::factory()->create([
            'name' => 'Fruta'
        ]);

        Category::factory()->create([
            'name' => 'Verdura'
        ]);

        Category::factory()->create([
            'name' => 'Refrescos'
        ]);
    }
}
