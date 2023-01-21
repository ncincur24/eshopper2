<?php

namespace Database\Seeders;

use App\Models\Nav;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NavSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    private array $navLinks = [
        [
            "title" => "Home",
            "route" => "home",
            "show" => "0",
            "icon" => null
        ],
        [
            "title" => "Products",
            "route" => "products.index",
            "show" => "0",
            "icon" => null
        ],
        [
            "title" => "Contact",
            "route" => "contact",
            "show" => "0",
            "icon" => null
        ],
        [
            "title" => "Home",
            "route" => "admin.home",
            "show" => "1",
            "icon" => "tachometer-alt"
        ],
        [
            "title" => "Users",
            "route" => "users.index",
            "show" => "1",
            "icon" => "users"
        ],
        [
            "title" => "Brands",
            "route" => "brands.index",
            "show" => "1",
            "icon" => "trademark"
        ],
        [
            "title" => "Orders",
            "route" => "admin.orders",
            "show" => "1",
            "icon" => "cart-arrow-down"
        ],
        [
            "title" => "Products",
            "route" => "admin.products",
            "show" => "1",
            "icon" => "edit"
        ],
        [
            "title" => "Messages",
            "route" => "admin.messages",
            "show" => "1",
            "icon" => "envelope"
        ]
    ];
    public function run()
    {
        foreach ($this->navLinks as $navLink) {
            Nav::create([
                "title" => $navLink["title"],
                "route" => $navLink["route"],
                "show" => $navLink["show"],
                "icon" => $navLink["icon"]
            ]);
        }
    }
}
