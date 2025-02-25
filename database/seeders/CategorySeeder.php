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
            'name' => 'Bebidas'
        ]);

        Category::factory()->create([
            'name' => 'Congelados'
        ]);

        Category::factory()->create([
            'name' => 'Frutas'
        ]);

        Category::factory()->create([
            'name' => 'Verduras'
        ]);

        Category::factory()->create([
            'name' => 'Refrescos'
        ]);
    }
}
