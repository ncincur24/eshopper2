<?php

namespace Database\Seeders;

use App\Models\Image;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $image = [
            [
                "src" => "puma2.jpg",
                "alt" => "Puma cruise picture"
            ],
            [
                "src" => "jordan2.jpg",
                "alt" =>  "Jordan max aura picture"
            ],
            [
                "src" => "adidas4.jpg",
                "alt" =>  "adidas NITEBALL "
            ],
            [
                "src" => "adidas1.jpg",
                "alt" =>  "adidas zx 2k boost"
            ],
            [
                "src" => "nike4.jpg",
                "alt" =>  "Nike force 1 ilg"
            ],
            [
                "src" => "puma1.jpg",
                "alt" =>  "Puma mayze bright"
            ],
            [
                "src" => "nike3.jpg",
                "alt" =>  "Nike air force 1 mid jewel"
            ],
            [
                "src" => "adidas2.jpg",
                "alt" =>  "adidas superstar tech"
            ],
            [
                "src" => "jordan1.jpg",
                "alt" =>  "jordan 11 low"
            ],
            [
                "src" => "nike1.jpg",
                "alt" =>  "Air max 95 essential"
            ],
            [
                "src" => "adidas3.jpg",
                "alt" =>  "adidas nmd r1"
            ],
            [
                "src" => "nike2.jpg",
                "alt" =>  "vapormax evo"
            ],
            [
                "src" => "converse.jpg",
                "alt" =>  "CONVERSE Chuck 70 "
            ],
        ];
        foreach ($image as $i) {
            Image::create([
                "src" => $i["src"],
                "alt" => $i["alt"]
            ]);
        }
    }
}
