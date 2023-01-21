<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\ActionLog;
use App\Models\Nav;
use App\Models\Order;
use App\Models\OrderInfo;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends BaseController
{
    public function __construct(private Order $order, private OrderInfo $orderInfo, ActionLog $actionLog)
    {
        parent::__construct($actionLog);
        $this->order = new Order();
        $this->orderInfo = new OrderInfo();
    }

    public function index(Request $request)
    {
        return view("user.checkout", ["total" => $request->get("total")]);
    }

    public function makeOrder(OrderRequest $request)
    {
        if ($request->ajax() && $request->method() == "POST" && $request->has("btn") ){
            try {
                DB::transaction(function () use ($request){
                    $id = $this->order->createOrder($request->get("address"), $request->get("total"));
                    $this->orderInfo->createOrderInfo($request->get("products"), $id->getAttribute("id"));
                });
                $this->logAction("User made order", $request);
                return response()->json([
                    "route" => route("home"),
                    "pass" => true
                ]);
            }
            catch (Exception $exception){
                \Log::error(uniqid()." ".$exception->getMessage());
                return response()->json("Sorry we had an server error");
            }
            catch (\Throwable $e) {
                \Log::error(uniqid()." ".$e->getMessage());
            }
        }
    }

    public function orderedItems()
    {
        return view("user.ordered-items", [
            "orders" => $this->order->getOrderedItems(),
            "info" => $this->orderInfo
        ]);
    }

    public function adminOrders()
    {
        return view("admin.pages.orders", [
            "adminNav" => Nav::where("show", 1)->get(),
            "orders" => $this->order->allOrders(),
            "info" => $this->orderInfo
        ]);
    }
}
