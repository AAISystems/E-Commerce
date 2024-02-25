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

        $os=\App\Models\Category::factory()->create([
            'name' => 'Sistemas operativos'
        ]);
       $office= \App\Models\Category::factory()->create([
            'name' => 'Ofimática'
        ]);
       $videoEditor= \App\Models\Category::factory()->create([
            'name' => 'Edición de vídeo'
        ]);
       $photoEditor= \App\Models\Category::factory()->create([
            'name' => 'Edición de fotografía'
        ]);
        
       $hrSoftware= \App\Models\Category::factory()->create([
            'name' => 'Sistemas de gestión de personal'
        ]);
       $bussinessSoftware= \App\Models\Category::factory()->create([
            'name' => 'Sistemas de gestión empresarial'
        ]);

        $windows7 = \App\Models\Product::factory()->create([
            'name' => 'Windows 7',
            'description' => '',
            'price' => '29.99',
            'stock' => '500',
        ]);
        $windows7->images()->create([
            'route' => 'img/products/windows7.jpg',
            'product_id' => $windows7->id
        ]);
        $windows7->categories()->attach($os);

        $windows8 = \App\Models\Product::factory()->create([
            'name' => 'Windows 8',
            'description' => '',
            'price' => '39.99',
            'stock' => '1500',
        ]);
        $windows8->images()->create([
            'route' => 'img/products/windows8.jpg',
            'product_id' => $windows8->id
        ]);
        $windows8->categories()->attach($os);

        $windows10 = \App\Models\Product::factory()->create([
            'name' => 'Windows 10 pro',
            'description' => '',
            'price' => '99.99',
            'stock' => '1500',
        ]);
        $windows10->images()->create([
            'route' => 'img/products/windows10.jpg',
            'product_id' => $windows10->id
        ]);
        $windows10->categories()->attach($os);

        $windows11 = \App\Models\Product::factory()->create([
            'name' => 'Windows 11 pro',
            'description' => '',
            'price' => '149.99',
            'stock' => '1500',
        ]);
        $windows11->images()->create([
            'route' => 'img/products/windows11.webp',
            'product_id' => $windows11->id
        ]);
        $windows11->categories()->attach($os);

        $office365pro = \App\Models\Product::factory()->create([
            'name' => 'Office 365 Pro',
            'description' => '',
            'price' => '149.99',
            'stock' => '100',
        ]);
        $office365pro->images()->create([
            'route' => 'img/products/office365Pro.jpg',
            'product_id' => $office365pro->id
        ]);
        $office365pro->categories()->attach($office);

        $office365personal = \App\Models\Product::factory()->create([
            'name' => 'Office 365 Personal',
            'description' => '',
            'price' => '124.99',
            'stock' => '2500',
        ]);
        $office365personal->images()->create([
            'route' => 'img/products/office365Personal.jpg',
            'product_id' => $office365personal->id
        ]);
        $office365personal->categories()->attach($office);

        $office365Family = \App\Models\Product::factory()->create([
            'name' => 'Office 365 Family',
            'description' => '',
            'price' => '144.99',
            'stock' => '2500',
        ]);
        $office365Family->images()->create([
            'route' => 'img/products/office365Family.jpg',
            'product_id' => $office365Family->id
        ]);
        $office365Family->categories()->attach($office);

        $capture = \App\Models\Product::factory()->create([
            'name' => 'Capture One',
            'description' => '',
            'price' => '124.99',
            'stock' => '2500',
        ]);
        $capture->images()->create([
            'route' => 'img/products/capture_one.jpg',
            'product_id' => $capture->id
        ]);
        $capture->categories()->attach($photoEditor);

        $lightroom = \App\Models\Product::factory()->create([
            'name' => 'Adobe Lightroom',
            'description' => '',
            'price' => '224.99',
            'stock' => '2500',
        ]);
        $lightroom->images()->create([
            'route' => 'img/products/lightroom.webp',
            'product_id' => $lightroom->id
        ]);
        $lightroom->categories()->attach($photoEditor);

        $dynamics = \App\Models\Product::factory()->create([
            'name' => 'Microsoft Dynamics 365',
            'description' => '',
            'price' => '134.99',
            'stock' => '2500',
        ]);
        $dynamics->images()->create([
            'route' => 'img/products/microsoftDynamics.jpg',
            'product_id' => $dynamics->id
        ]);
        $dynamics->categories()->attach($bussinessSoftware);

        $photolab = \App\Models\Product::factory()->create([
            'name' => 'PhotoLab 7',
            'description' => '',
            'price' => '214.99',
            'stock' => '2500',
        ]);
        $photolab->images()->create([
            'route' => 'img/products/photolab7.jpg',
            'product_id' => $photolab->id
        ]);
        $photolab->categories()->attach($photoEditor);

        $photoshop = \App\Models\Product::factory()->create([
            'name' => 'Adobe Photoshop',
            'description' => '',
            'price' => '164.99',
            'stock' => '2500',
        ]);
        $photoshop->images()->create([
            'route' => 'img/products/photoshop.jpg',
            'product_id' => $photoshop->id
        ]);
        $photoshop->categories()->attach($photoEditor);


        $premiere = \App\Models\Product::factory()->create([
            'name' => 'Adobe Premiere Pro',
            'description' => '',
            'price' => '249.99',
            'stock' => '2500',
        ]);
        $premiere->images()->create([
            'route' => 'img/products/premierePro.jpg',
            'product_id' => $premiere->id
        ]);
        $premiere->categories()->attach($videoEditor);

        $workforce = \App\Models\Product::factory()->create([
            'name' => 'WorkForce Now',
            'description' => '',
            'price' => '324.99',
            'stock' => '2500',
        ]);
        $workforce->images()->create([
            'route' => 'img/products/workforceNow.webp',
            'product_id' => $workforce->id
        ]);
        $workforce->categories()->attach($hrSoftware);

        $zohopeople = \App\Models\Product::factory()->create([
            'name' => 'ZohoPeople',
            'description' => '',
            'price' => '299.99',
            'stock' => '2500',
        ]);
        $zohopeople->images()->create([
            'route' => 'img/products/zohoPeople.png',
            'product_id' => $zohopeople->id
        ]);
        $zohopeople->categories()->attach($hrSoftware);

        $vegas = \App\Models\Product::factory()->create([
            'name' => 'Sony Vegas Pro',
            'description' => '',
            'price' => '299.99',
            'stock' => '2500',
        ]);
        $vegas->images()->create([
            'route' => 'img/products/vegasPro.jpg',
            'product_id' => $vegas->id
        ]);
        $vegas->categories()->attach($videoEditor);

        
    }
}
