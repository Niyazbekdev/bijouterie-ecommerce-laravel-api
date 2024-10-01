<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => json_encode([
                    'kaa' => 'Әеллер билезиклери',
                    'ru' => 'Женский браслет',
                ]),
                'description' => json_encode([
                    'kaa' => 'Әеллер билезиклери.',
                    'ru' => 'Женский браслет',
                ]),
                'price' => 25000,
                'quantity' => 5,
                'category_id' => 3,
                'brend_id' => 1,
                'discount_price' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => json_encode([
                    'kaa' => 'Әеллер жүзиклери комплекси, 2.',
                    'ru' => 'Набор женских колец, 2 шт',
                ]),
                'description' => json_encode([
                    'kaa' => 'Әеллер үзиклери комплекси, 2.',
                    'ru' => 'Набор женских колец, 2 шт',
                ]),
                'price' => 6000,
                'quantity' => 8,
                'category_id' => 4,
                'brend_id' => null,
                'discount_price' => 5000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => json_encode([
                    'kaa' => 'Пуссетлар шынжырлары комплекси, ҳаяллардың қолғаплары, 7 жуп',
                    'ru' => 'Набор сережек пусетов, женские серьги гвоздики, 7 пар',
                ]),
                'description' => json_encode([
                    'kaa' => 'Пуссетлар шынжырлары комплекси, ҳаяллардың қолғаплары, 7 жуп',
                    'ru' => 'Набор сережек пусетов, женские серьги гвоздики, 7 пар',
                ]),
                'price' => 16000,
                'quantity' => 3,
                'category_id' => 2,
                'brend_id' => null,
                'discount_price' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        $colors = [
            [
                'product_id' => 2,
                'color_id' => 1,
                'quantity' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 2,
                'color_id' => 2,
                'quantity' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 2,
                'color_id' => 3,
                'quantity' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        $media = [
            [
                'collection_name' => 'test',
                'file_name' => '1726113466_66e266ba80f20.jpg',
                'path' => 'test/1726113466_66e266ba80f20.jpg',
                'model_id' => 2,
                'model_type' => 'App\\Models\\Product',
                'is_main' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'collection_name' => 'test',
                'file_name' => '1726113750_66e267d6ed27c.jpg',
                'path' => 'test/1726113750_66e267d6ed27c.jpg',
                'model_id' => 2,
                'model_type' => 'App\\Models\\Product',
                'is_main' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'collection_name' => 'test',
                'file_name' => '1726113861_66e26845ead10.jpg',
                'path' => 'test/1726113861_66e26845ead10.jpg',
                'model_id' => 1,
                'model_type' => 'App\\Models\\Product',
                'is_main' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'collection_name' => 'test',
                'file_name' => '1726114029_66e268ed716af.jpg',
                'path' => 'test/1726114029_66e268ed716af.jpg',
                'model_id' => 1,
                'model_type' => 'App\\Models\\Product',
                'is_main' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'collection_name' => 'test',
                'file_name' => '1726116544_66e272c091ffc.png',
                'path' => 'test/1726116544_66e272c091ffc.png',
                'model_id' => 3,
                'model_type' => 'App\\Models\\Product',
                'is_main' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        $brend = [
            [
                'name' => 'Allure',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Beauty Fox',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        $discount = [
            [
                'product_id' => 2,
                'name' => 'guzgi akciya',
                'percent' => null,
                'sum' => 1000,
                'from_date' => "2024-09-01 01:00:00",
                'to_date' => "2024-11-30 02:00:00",
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        DB::table('brends')->insert($brend);
        Product::insert($products);
        DB::table('color_product')->insert($colors);
        DB::table('media')->insert($media);
        DB::table('discounts')->insert($discount);
    }
}
