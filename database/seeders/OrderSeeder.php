<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $orders = [
            [
                'id' => 1,
                'user_id' => 2,
                'status_id' => 2,
                'payment_type_id' => 1,
                'total_price' => 10000,
                'status_date' => now(),
                'products' => json_encode([
                    [
                        'id' => 2,
                        'name' => [
                            'kaa' => 'Әеллер жүзиклери комплекси, 2.',
                            'ru' => 'Набор женских колец, 2 шт',
                        ],
                        'quantity' => 1,
                        'price' => 10000,
                        'image' => [
                            'id' => 4,
                            'url' => config('app.url') . '/storage/test/1726113466_66e266ba80f20.jpg',
                        ]
                    ]
                ]),
                'product_count' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        $review = [
            [
                'user_id' => 2,
                'product_id' => 2,
                'rating' => 5,
                'comment' => 'zor eken',
                'answers' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        DB::table('orders')->insert($orders);
        DB::table('reviews')->insert($review);
    }
}
