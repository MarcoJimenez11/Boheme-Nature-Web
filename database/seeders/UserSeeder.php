<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Marco',
            'email' => 'test@example.com',
            'password' => bcrypt('11'),
            'is_admin' => true
        ]);
        
        User::factory(40)->create();
    }
}
