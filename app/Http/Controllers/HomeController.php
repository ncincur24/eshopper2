<?php

namespace App\Http\Controllers;

use App\Models\Nav;
use App\Models\Product;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Array_;

class HomeController extends BaseController
{
    public function index()
    {
        return view("pages.home", ["newest" => (new Product())->newsestProducts()]);
    }
}
