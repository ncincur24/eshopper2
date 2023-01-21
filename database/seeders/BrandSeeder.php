<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    private array $brands = [
        [
            "name" => "Adidas"
        ],
        [
            "name" => "Nike"
        ],
        [
            "name" => "Puma"
        ],
        [
            "name" => "Under Armor"
        ],
        [
            "name" => "Converse"
        ],
        [
            "name" => "Jordan"
        ]
    ];
    public function run()
    {
        foreach ($this->brands as $b){
            Brand::create([
               "name" => $b["name"]
            ]);
        }
    }
}
