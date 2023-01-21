<?php

namespace App\Http\Controllers;

use App\Models\ActionLog;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends BaseController
{
    public function __construct(ActionLog $actionLog)
    {
        parent::__construct($actionLog);
    }

    public function index()
    {
        return view("pages.cart");
    }

    public function productsInCart(Request $request)
    {
        $id = $request->get("ids");
        return response()->json([
            "end" => true,
            "products" => Product::find($id),
            "user" => session()->has("user")
        ]);
    }
}
