<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $orders = [
            [
                "address" => "Nemanjina 32",
                "total_price" => 920.13,
                "user_id" => 1
            ],
            [
                "address" => "Kralja Milana bb",
                "total_price" => 361.57,
                "user_id" => 2
            ],
            [
                "address" => "Takovska 12",
                "total_price" => 249.58,
                "user_id" => 2
            ]
        ];
        foreach ($orders as $o) {
            Order::create([
                "address" => $o["address"],
                "total_price" => $o["total_price"],
                "user_id" => $o["user_id"]
            ]);
        }
    }
}
