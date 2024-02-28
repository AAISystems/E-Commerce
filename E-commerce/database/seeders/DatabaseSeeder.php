<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
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

        // Creación de categorías...
        $os = Category::factory()->create(['name' => 'Sistemas operativos']);
        $office = Category::factory()->create(['name' => 'Ofimática']);
        $videoEditor = Category::factory()->create(['name' => 'Edición de vídeo']);
        $photoEditor = Category::factory()->create(['name' => 'Edición de fotografía']);
        $hrSoftware = Category::factory()->create(['name' => 'Sistemas de gestión de personal']);
        $bussinessSoftware = Category::factory()->create(['name' => 'Sistemas de gestión empresarial']);

        // Creación de productos con descripciones más extensas...
        $windows7 = Product::factory()->create([
            'name' => 'Windows 7',
            'description' => 'Windows 7 es un sistema operativo que ha resistido la prueba del tiempo. Con su interfaz intuitiva y gran estabilidad, ha sido un favorito de muchos usuarios durante años. Ideal para aquellos que buscan un sistema operativo confiable y eficiente.',
            'price' => '29.99',
            'stock' => '500',
        ]);
        $windows7->images()->create(['route' => 'img/products/windows7.jpg']);
        $windows7->categories()->attach($os);

        $windows8 = Product::factory()->create([
            'name' => 'Windows 8',
            'description' => 'Windows 8 representa una evolución en la interfaz de usuario de Microsoft. Con su diseño moderno y optimizaciones, ofrece una experiencia de usuario mejorada. Perfecto para aquellos que buscan lo último en tecnología de sistemas operativos.',
            'price' => '39.99',
            'stock' => '1500',
        ]);
        $windows8->images()->create(['route' => 'img/products/windows8.jpg']);
        $windows8->categories()->attach($os);

        $windows10 = Product::factory()->create([
            'name' => 'Windows 10 pro',
            'description' => 'Windows 10 Pro es la última versión del sistema operativo de Microsoft. Con características avanzadas de seguridad y rendimiento, es perfecto para usuarios profesionales y empresas que buscan un sistema operativo confiable y robusto.',
            'price' => '99.99',
            'stock' => '1500',
        ]);
        $windows10->images()->create(['route' => 'img/products/windows10.jpg']);
        $windows10->categories()->attach($os);

        $windows11 = Product::factory()->create([
            'name' => 'Windows 11 pro',
            'description' => 'Windows 11 Pro es la última versión del sistema operativo de Microsoft, diseñada para brindar una experiencia moderna y eficiente. Con su interfaz rediseñada y nuevas características, es ideal para aquellos que buscan lo último en tecnología de sistemas operativos.',
            'price' => '149.99',
            'stock' => '1500',
        ]);
        $windows11->images()->create(['route' => 'img/products/windows11.webp']);
        $windows11->categories()->attach($os);

        $office365pro = Product::factory()->create([
            'name' => 'Office 365 Pro',
            'description' => 'Office 365 Pro es la suite de productividad definitiva para empresas. Incluye todas las aplicaciones de Office, además de servicios en la nube avanzados. Perfecto para empresas que buscan optimizar la colaboración y la productividad.',
            'price' => '149.99',
            'stock' => '100',
        ]);
        $office365pro->images()->create(['route' => 'img/products/office365Pro.jpg']);
        $office365pro->categories()->attach($office);

        $office365personal = Product::factory()->create([
            'name' => 'Office 365 Personal',
            'description' => 'Office 365 Personal es la solución perfecta para usuarios individuales que desean acceder a las aplicaciones de Office en todos sus dispositivos. Incluye servicios en la nube para almacenamiento y colaboración.',
            'price' => '124.99',
            'stock' => '2500',
        ]);
        $office365personal->images()->create(['route' => 'img/products/office365Personal.jpg']);
        $office365personal->categories()->attach($office);

        $office365Family = Product::factory()->create([
            'name' => 'Office 365 Family',
            'description' => 'Office 365 Family es la elección ideal para familias que desean acceder a las aplicaciones de Office y compartir servicios en la nube. Permite la colaboración y la organización familiar de manera efectiva.',
            'price' => '144.99',
            'stock' => '2500',
        ]);
        $office365Family->images()->create(['route' => 'img/products/office365Family.png']);
        $office365Family->categories()->attach($office);

        $capture = Product::factory()->create([
            'name' => 'Capture One',
            'description' => 'Capture One es una potente herramienta de edición de fotografías utilizada por profesionales en todo el mundo. Ofrece funciones avanzadas de ajuste y corrección de color, proporcionando un flujo de trabajo eficiente para fotógrafos exigentes.',
            'price' => '124.99',
            'stock' => '2500',
        ]);
        $capture->images()->create(['route' => 'img/products/capture_one.jpg']);
        $capture->categories()->attach($photoEditor);

        $lightroom = Product::factory()->create([
            'name' => 'Adobe Lightroom',
            'description' => 'Adobe Lightroom es una herramienta esencial para fotógrafos que desean mejorar y organizar sus imágenes. Ofrece funciones avanzadas de edición no destructiva y una interfaz intuitiva para mejorar la eficiencia en el flujo de trabajo.',
            'price' => '224.99',
            'stock' => '2500',
        ]);
        $lightroom->images()->create(['route' => 'img/products/lightroom.webp']);
        $lightroom->categories()->attach($photoEditor);

        $dynamics = Product::factory()->create([
            'name' => 'Microsoft Dynamics 365',
            'description' => 'Microsoft Dynamics 365 es una suite de aplicaciones empresariales que abarca CRM y ERP. Ofrece soluciones integrales para la gestión de clientes, operaciones empresariales y más. Ideal para empresas que buscan una plataforma unificada para sus necesidades empresariales.',
            'price' => '134.99',
            'stock' => '2500',
        ]);
        $dynamics->images()->create(['route' => 'img/products/microsoftDynamics.jpg']);
        $dynamics->categories()->attach($bussinessSoftware);

        $photolab = Product::factory()->create([
            'name' => 'PhotoLab 7',
            'description' => 'PhotoLab 7 es una herramienta completa para la edición de fotografías. Ofrece una amplia gama de herramientas de ajuste y mejora, así como funciones avanzadas para aquellos que buscan llevar sus habilidades de edición de fotos al siguiente nivel.',
            'price' => '214.99',
            'stock' => '2500',
        ]);
        $photolab->images()->create(['route' => 'img/products/photolab7.jpg']);
        $photolab->categories()->attach($photoEditor);

        $photoshop = Product::factory()->create([
            'name' => 'Adobe Photoshop',
            'description' => 'Adobe Photoshop es el software líder en edición de imágenes y diseño gráfico. Con herramientas avanzadas de manipulación de imágenes y creación, es la elección de profesionales creativos en todo el mundo. Perfecto para aquellos que buscan resultados de alta calidad.',
            'price' => '164.99',
            'stock' => '2500',
        ]);
        $photoshop->images()->create(['route' => 'img/products/photoshop.jpg']);
        $photoshop->categories()->attach($photoEditor);


        $premiere = Product::factory()->create([
            'name' => 'Adobe Premiere Pro',
            'description' => 'Adobe Premiere Pro es una herramienta de edición de video profesional utilizada por cineastas y creadores de contenido. Ofrece características avanzadas de edición, efectos y rendimiento óptimo. Para aquellos que buscan llevar sus habilidades de edición de video al siguiente nivel.',
            'price' => '249.99',
            'stock' => '2500',
        ]);
        $premiere->images()->create(['route' => 'img/products/premierePro.jpg']);
        $premiere->categories()->attach($videoEditor);

        $workforce = Product::factory()->create([
            'name' => 'WorkForce Now',
            'description' => 'WorkForce Now es un sistema de gestión de personal que simplifica las operaciones relacionadas con los recursos humanos. Ofrece soluciones para el seguimiento del tiempo, la nómina y la gestión del talento. Perfecto para empresas que buscan optimizar sus procesos de recursos humanos.',
            'price' => '324.99',
            'stock' => '2500',
        ]);
        $workforce->images()->create(['route' => 'img/products/workforceNow.webp']);
        $workforce->categories()->attach($hrSoftware);

        $zohopeople = Product::factory()->create([
            'name' => 'ZohoPeople',
            'description' => 'ZohoPeople es una solución integral para la gestión de recursos humanos. Ofrece herramientas para el seguimiento del tiempo, la gestión del talento y la colaboración. Perfecto para empresas que buscan optimizar sus procesos de recursos humanos de manera eficiente.',
            'price' => '299.99',
            'stock' => '2500',
        ]);
        $zohopeople->images()->create(['route' => 'img/products/zohoPeople.png']);
        $zohopeople->categories()->attach($hrSoftware);

        $vegas = Product::factory()->create([
            'name' => 'Sony Vegas Pro',
            'description' => 'Sony Vegas Pro es una poderosa herramienta de edición de video utilizada por profesionales de la industria. Con funciones avanzadas de edición y efectos, es perfecto para aquellos que buscan resultados profesionales en la producción de video.',
            'price' => '299.99',
            'stock' => '2500',
        ]);
        $vegas->images()->create(['route' => 'img/products/vegasPro.jpg']);
        $vegas->categories()->attach($videoEditor);

        // Agrega más productos según sea necesario...

        // Fin del código...
    }
}
