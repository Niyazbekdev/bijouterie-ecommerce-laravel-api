<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'id' => 1,
                'name' => json_encode([
                    'kaa' => 'əйеллер аксессуарлары',
                    'ru' => 'женские аксессуары',
                ]),
                'icon' => null,
                'parent_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'name' => json_encode([
                    'kaa' => 'ер адамлар аксессуарлары',
                    'ru' => 'мужские аксессуары'
                ]),
                'icon' => null,
                'parent_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'name' => json_encode([
                    'kaa' => 'саатлар',
                    'ru' => 'часы'
                ]),
                'icon' => null,
                'parent_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'name' => json_encode([
                    'kaa' => 'зергерлик буйымлары',
                    'ru' => 'бижутерные украшения',
                ]),
                'icon' => null,
                'parent_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'name' => json_encode([
                    'kaa' => 'билезиклер',
                    'ru' => 'браслеты'
                ]),
                'icon' => null,
                'parent_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 6,
                'name' => json_encode([
                    'kaa' => 'жүзиклер',
                    'ru' => 'кольца'
                ]),
                'icon' => null,
                'parent_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('categories')->insert($categories);
    }
}
