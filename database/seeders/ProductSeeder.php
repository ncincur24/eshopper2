<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            [
                "brand" => 3,
                "name" => "PUMA CRUISE RIDER SILK ROAD",
                "description" => "Time for a rewind. PUMA x THUNDERCATS reimagines the cult-classic ‘80s TV show with futuristic design and throwback graphics. This edition of the RS-X T3CH features bold pops of color and amplified detailing in the upper.",
                "price" => 90,
                "image" => 1
            ],
            [
                "brand" => 6,
                "name" => "NIKE Jordan Max Aura 3",
                "description" => "Russell Westbrook is fast. These shoes match his quickness with updated cushioning, data-informed traction and a full-foot fit system to keep him in control. With a rugged utility look combined with a purposeful clash of colours and materials, this model speaks to the core of Russell's 'Why Not?' mantra.",
                "price" => 75,
                "image" => 2
            ],
            [
                "brand" => 1,
                "name" => "ADIDAS FORUM LOW",
                "description" => "Clean, fresh, understated style that takes your breath away. That's what you'll see when you pull these adidas kicks out of their box. Tonal 3-Stripes on the uncluttered synthetic leather upper rock a heritage vibe. A cushiony midsole adds soft support over the retro rubber outsole.",
                "price" => 120,
                "image" => 3
            ],
            [
                "brand" => 1,
                "name" => "ADIDAS ZX 2K BOOST 2.0",
                "description" => "Take advantage of today. These running shoes use the latest innovations to keep you striding comfortably and confidently. BOOST delivers incredible energy return and instant comfort while an adidas PRIMEKNIT upper wraps the foot with a supportive fit that enhances every move. A Linear Energy Push system integrated with the outsole increases stability for extra responsiveness.",
                "price" => 105,
                "image" => 4
            ],
            [
                "brand" => 2,
                "name" => "NIKE AIR FORCE 1 ILG",
                "description" => "The Nike Air Force 1 ILG puts a playful twist on a classic b-ball design.Using a layered approach, doubling the branding and exaggerating the midsole, it highlights AF-1 DNA with a bold, new look.",
                "price" => 150,
                "image" => 5
            ],
            [
                "brand" => 3,
                "name" => "PUMA MAYZE BRIGHT HEIGHTS",
                "description" => "The MAYZE BRIGHT HEIGHTS hit the scene in 1968 and has been changing the game ever since. It’s been worn by the icons of every generation and it’s stayed classic through it all. This year, we relaunch the Suede with fresh colorways and subtle design updates. Classic as ever, for all-time.",
                "price" => 110,
                "image" => 6
            ],
            [
                "brand" => 2,
                "name" => "NIKE Air Force 1 Mid Jewel",
                "description" => "A staple since our inception in 1972 with zour Air Force, our iconic logo makes a statement on this Air Force 1 and gives a cool, new take on the basketball icon from the '80s.",
                "price" => 179,
                "image" => 7
            ],
            [
                "brand" => 1,
                "name" => "ADIDAS SUPERSTAR OT TECH",
                "description" => "Talk about standing the test of time. The adidas Superstar Shoes have continued to make their mark on our cultural landscape for over 50 years. And while certain things have changed, their signature details have not. Like the iconic rubber shell toe or classic serrated 3-Stripes. This version emphasizes them in different ways and different colors, and goes ahead and adds some extra glam with lace jewels.",
                "price" => 90,
                "image" => 8
            ],
            [
                "brand" => 2,
                "name" => "NIKE Air Jordan 11 CMFT Low",
                "description" => "The Air Jordan 11 CMFT Low isn't just the next shoe up in the iconic franchise; it's an expression of the drive and energy that sparked a basketball revolution.It's one of the lightest Air Jordan game shoes to date, featuring minimal but durable Leno-Weave upper reinforced with a TPU ribbon.It also comes equipped with a full-length Zoom Air Strobel unit stitched directly to the upper, stacked with a Zoom Air unit underneath the forefoot, providing a sensation of energy return and elite responsiveness.Step on the court with the confidence that whatever you do—it's light work.",
                "price" => 108,
                "image" => 9
            ],
            [
                "brand" => 2,
                "name" => "NIKE Air Max 95 Essential",
                "description" => "Let your attitude have the edge in the Nike Air Max T95 Essential, the rebellious icon recrafted for the future.Offering a tuned Air experience that delivers premium stability and unbelievable cushioning, rolled into a futuristic design crafted from at least 20% recycled materials by weight.The speckles in the rubber outsole are made from Nike Grind, which is recycled waste (i.e. the scraps) from the footwear manufacturing process.",
                "price" => 99,
                "image" => 10
            ],
            [
                "brand" => 1,
                "name" => "ADIDAS NMD_R1 ",
                "description" => "Runners chase progress with every step. That's why we used data from thousands of athletes to inform the design of these running shoes. They have an adidas 4D midsole that's precisely coded to absorb impact, support your gait and make running feel a little easier. The lattice structure is angled to redirect the energy of every footstrike into forward motion.",
                "price" => 77,
                "image" => 11
            ],
            [
                "brand" => 2,
                "name" => "NIKE Air Vapormax EVO ",
                "description" => "A pop of colour with tone-on-tone details gives just the right amount of flair to a monochrome look. The Air window is sleek and streamlined with the cushioned support you know and love.",
                "price" => 175,
                "image" => 12
            ],
            [
                "brand" => 5,
                "name" => "CONVERSE Chuck 70 ",
                "description" => "The on-court icon from 1986, completely transformed for what's next. Sport-inspired colorblocking on the premium leather upper meets the PU foam collar and wrapped, color-popped rubber outsole for maximum comfort. The Y-bar paneling and woven tongue label reference where we've been, while the exaggerated CX midsole and lightweight, responsive CX comfort sockliner take you where you're going.",
                "price" => 67,
                "image" => 13
            ]
        ];
        foreach ($products as $p){
            Product::create([
                "name" => $p["name"],
                "description" => $p["description"],
                "current_price" => $p["price"],
                "brand_id" => $p["brand"],
                "img_id" => $p["image"]
            ]);
        }
    }
}
