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
        \App\Models\User::factory()->create([
            'name' => 'user',
            'email' => 'user@email.com',
        ]);
        \App\Models\Wishlist::factory()->create([
            'user_id' => 2,

        ]);
        \App\Models\Cart::factory()->create([
            'amount' => 0,
            'total_products' => 0,
            'user_id' => 2,

        ]);

        \App\Models\Cart::factory()->create([
            'amount' => 0,
            'total_products' => 0,
            'user_id' => 1,

        ]);

        \App\Models\Product::factory()->create([
            'name' => 'Ps5',
            'description' => 'Videoconsola',
            'price' => '600',
            'stock' => '50',
        ]);
        \App\Models\Product::factory()->create([
            'name' => 'Windows 11 pro',
            'description' => 'Sistema operativo',
            'price' => '111',
            'stock' => '1500',
        ]);
        \App\Models\Product::factory()->create([
            'name' => 'Microsoft Office',
            'description' => 'Editor de texto',
            'price' => '150',
            'stock' => '100',
        ]);
        \App\Models\Product::factory()->create([
            'name' => 'Windows XP',
            'description' => 'Sistema operativo',
            'price' => '15',
            'stock' => '2500',
        ]);

        \App\Models\Category::factory()->create([
            'name' => 'Sistemas operativos'
        ]);
        \App\Models\Category::factory()->create([
            'name' => 'Ofimática'
        ]);
        \App\Models\Category::factory()->create([
            'name' => 'Edición de vídeo'
        ]);
        \App\Models\Category::factory()->create([
            'name' => 'Edición de fotografía'
        ]);
        \App\Models\Category::factory()->create([
            'name' => 'Edición de audio'
        ]);
        \App\Models\Category::factory()->create([
            'name' => 'Sistemas de gestión de personal'
        ]);
        \App\Models\Category::factory()->create([
            'name' => 'Sistemas de gestión empresarial'
        ]);
    }
}
