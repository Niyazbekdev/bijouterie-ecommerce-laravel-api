<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            [
                'name' => json_encode([
                    'kaa' => 'жана буйиртпа',
                    'ru' => 'новый заказ',
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => json_encode([
                    'kaa' => 'толенди',
                    'ru' => 'оплачен'
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        DB::table('statuses')->insert($statuses);
    }
}
