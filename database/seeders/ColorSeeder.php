<?php

namespace Database\Seeders;

use App\Models\Color;
use Illuminate\Database\Seeder;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $colors = [
            [
                'name' => json_encode([
                    'kaa' => 'сары',
                    'ru' => 'жёлтый'
                ]),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => json_encode([
                    'kaa' => 'алтын реңли',
                    'ru' => 'золотой',
                ]),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => json_encode([
                    'kaa' => 'ақ',
                    'ru' => 'белый',
                ]),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => json_encode([
                    'kaa' => 'апелсин реңли.',
                    'ru' => 'оранжевый',
                ]),
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];

        Color::insert($colors);
    }
}
