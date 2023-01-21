<?php

namespace Database\Seeders;

use App\Models\Price;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $prices = [
            [
                "amount" => 140,
                "product_id" => 3
            ],
            [
                "amount" => 135,
                "product_id" => 8
            ],
            [
                "amount" => 120,
                "product_id" => 3
            ],
            [
                "amount" => 77,
                "product_id" => 11
            ],
            [
                "amount" => 90,
                "product_id" => 8
            ],
            [
                "amount" => 195,
                "product_id" => 5
            ],
            [
                "amount" => 105,
                "product_id" => 4
            ],
            [
                "amount" => 67,
                "product_id" => 13
            ],
            [
                "amount" => 150,
                "product_id" => 5
            ],
            [
                "amount" => 220,
                "product_id" => 12
            ],
            [
                "amount" => 160,
                "product_id" => 6
            ],
            [
                "amount" => 179,
                "product_id" => 7
            ],
            [
                "amount" => 180,
                "product_id" => 2
            ],
            [
                "amount" => 108,
                "product_id" => 9
            ],
            [
                "amount" => 99,
                "product_id" => 10
            ],
            [
                "amount" => 175,
                "product_id" => 12
            ],
            [
                "amount" => 75,
                "product_id" => 2
            ],
            [
                "amount" => 90,
                "product_id" => 1
            ],
            [
                "amount" => 110,
                "product_id" => 6
            ]
        ];
        foreach ($prices as $p){
            Price::create([
                "amount" => $p["amount"],
                "product_id" => $p["product_id"]
            ]);
        }
    }
}
