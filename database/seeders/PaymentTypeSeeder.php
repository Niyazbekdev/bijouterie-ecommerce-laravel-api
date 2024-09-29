<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $paymentTypes = [
            [
                'name' => 'click',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'payme',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'naq',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        DB::table('payment_types')->insert($paymentTypes);
    }
}
