<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();


        \App\Models\Role::factory()->create([
            'rol' => 'admin',
        ]);

        \App\Models\User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@email.com',
            'roles_id' => '1',
        ]);

        \App\Models\Product::factory()->create([
            'name' => 'Ps5',
            'description' => 'Una play 5 guapisima bro',
            'price' => '600',
            'stock' => '50',
        ]);
        \App\Models\Product::factory()->create([
            'name' => 'Ventanas 11 pro',
            'description' => 'Un SO guapisimo',
            'price' => '111',
            'stock' => '1500',
        ]);
        \App\Models\Product::factory()->create([
            'name' => 'MicroSuave Oficina',
            'description' => 'Pa que escribas',
            'price' => '150',
            'stock' => '100',
        ]);
        \App\Models\Product::factory()->create([
            'name' => 'Ventanas XP',
            'description' => 'El viejete',
            'price' => '15',
            'stock' => '2500',
        ]);
    }
}
