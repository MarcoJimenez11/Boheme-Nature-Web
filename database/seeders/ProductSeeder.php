<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Product::factory(100)->create();

        Product::create([
            'name' => 'Jabón de lavanda',
            'description' => 'Este jabón está hecho con aceite esencial de lavanda, ideal para relajar y suavizar la piel.',
            'price' => 9.40,
            'stock' => 100,
            'image' => "images/lavanda.jpg",
            'category_id' => 1
        ]);

        Product::create([
            'name' => 'Jabón de aloe vera',
            'description' => 'Este jabón está hecho con extracto de aloe vera, perfecto para hidratar y calmar la piel.',
            'price' => 9.40,
            'stock' => 100,
            'image' => "images/alore_vera.jpg",
            'category_id' => 1
        ]);

        Product::create([
            'name' => 'Jabón de leche de cabra',
            'description' => 'Este jabón está hecho con leche de cabra, conocido por sus propiedades hidratantes y nutritivas para la piel.',
            'price' => 10.70,
            'stock' => 100,
            'image' => "images/leche_de_cabra.jpg",
            'category_id' => 1
        ]);

        Product::create([
            'name' => 'Jabón de coco y mango',
            'description' => 'Este jabón está hecho con aceite de coco y extracto de mango, ideal para hidratar y suavizar la piel.',
            'price' => 9.90,
            'stock' => 100,
            'image' => "images/coco_y_mango.jpg",
            'category_id' => 1
        ]);

        Product::create([
            'name' => 'Jabón de argán',
            'description' => 'Este jabón está hecho con aceite de argán, conocido por sus propiedades hidratantes y antioxidantes.',
            'price' => 9.40,
            'stock' => 100,
            'image' => "images/argan.jpg",
            'category_id' => 1
        ]);

        Product::create([
            'name' => 'Jabón de caléndula',
            'description' => 'Este jabón está hecho con extracto de caléndula, ideal para pieles sensibles y con irritaciones.',
            'price' => 9.40,
            'stock' => 100,
            'image' => "images/calendula.jpg",
            'category_id' => 1
        ]);

        Product::create([
            'name' => 'Jabón de karité',
            'description' => 'Este jabón está hecho con manteca de karité, conocido por sus propiedades hidratantes y nutritivas para la piel.',
            'price' => 10.80,
            'stock' => 100,
            'image' => "images/karite.jpg",
            'category_id' => 1
        ]);

        Product::create([
            'name' => 'Jabón de laurel',
            'description' => 'Este jabón está hecho con aceite de laurel, conocido por sus propiedades antibacterianas y antiinflamatorias.',
            'price' => 9.40,
            'stock' => 100,
            'image' => "images/laurel.jpg",
            'category_id' => 1
        ]);

        Product::create([
            'name' => 'Jabón de mango',
            'description' => 'Este jabón está hecho con extracto de mango, ideal para hidratar y suavizar la piel.',
            'price' => 9.40,
            'stock' => 100,
            'image' => "images/mango.jpg",
            'category_id' => 1
        ]);

        Product::create([
            'name' => 'Jabón de rosa mosqueta',
            'description' => 'Este jabón está hecho con aceite de rosa mosqueta, conocido por sus propiedades regenerativas y antiarrugas.',
            'price' => 9.40,
            'stock' => 100,
            'image' => "images/rosa_mosqueta.jpg",
            'category_id' => 1
        ]);

        Product::create([
            'name' => 'Jabón de arcilla blanca',
            'description' => 'Este jabón está hecho con arcilla blanca, ideal para limpiar y purificar la piel.',
            'price' => 9.40,
            'stock' => 100,
            'image' => "images/arcilla_blanca.jpg",
            'category_id' => 1
        ]);

        Product::create([
            'name' => 'Vela de citronela',
            'description' => 'Esta vela está hecha con aceite esencial de citronela, ideal para repeler mosquitos y otros insectos.',
            'price' => 12.10,
            'stock' => 100,
            'image' => "images/citronela.jpg",
            'category_id' => 2
        ]);

        Product::create([
            'name' => 'Vela fanal',
            'description' => 'Esta vela es un fanal decorativo, ideal para iluminar y ambientar cualquier espacio.',
            'price' => 12.30,
            'stock' => 100,
            'image' => "images/fanal.jpg",
            'category_id' => 2
        ]);

        Product::create([
            'name' => 'Vela decorativa',
            'description' => 'Esta vela tiene un diseño decorativo, ideal para ambientar cualquier espacio.',
            'price' => 2.80,
            'stock' => 200,
            'image' => "images/vela_decorativa.jpg",
            'category_id' => 2
        ]);

        Product::create([
            'name' => 'Bomba de baño de estrella',
            'description' => 'Esta bomba de baño tiene forma de estrella, ideal para relajarse y disfrutar de un baño aromático.',
            'price' => 2.60,
            'stock' => 100,
            'image' => "images/bombas_estrella.jpg",
            'category_id' => 3
        ]);

        Product::create([
            'name' => 'Sales de baño de lavanda',
            'description' => 'Estas sales de baño están hechas con aceite esencial de lavanda, ideal para relajar y suavizar la piel.',
            'price' => 6.90,
            'stock' => 100,
            'image' => "images/sales.jpg",
            'category_id' => 3
        ]);
    }
}
