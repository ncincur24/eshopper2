<?php

namespace Database\Seeders;

use App\Models\OrderInfo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ordersInfos = [
            [
                "quantity" => 1,
                "product_id" => 2,
                "order_id" => 1
            ],
            [
                "quantity" => 5,
                "product_id" => 3,
                "order_id" => 1
            ],
            [
                "quantity" => 3,
                "product_id" => 1,
                "order_id" => 1
            ],
            [
                "quantity" => 1,
                "product_id" => 8,
                "order_id" => 2
            ],
            [
                "quantity" => 2,
                "product_id" => 7,
                "order_id" => 2
            ],
            [
                "quantity" => 2,
                "product_id" => 1,
                "order_id" => 3
            ]
        ];
        foreach ($ordersInfos as $o) {
            OrderInfo::create([
                "quantity" => $o["quantity"],
                "product_id" => $o["product_id"],
                "order_id" => $o["order_id"]
            ]);
        }
    }
}
