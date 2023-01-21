<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * App\Models\OrderInfo
 *
 * @property int $id
 * @property int $quantity
 * @property int $product_id
 * @property int $order_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|OrderInfo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderInfo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderInfo query()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderInfo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderInfo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderInfo whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderInfo whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderInfo whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderInfo whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class OrderInfo extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function createOrderInfo($products, $id)
    {
        foreach ($products as $p){
            $this::create([
               "quantity" => $p["quantity"],
               "product_id" => $p["id"],
                "order_id" => $id
            ]);
        }
    }

    public function singleOrder($id)
    {
        return $this
            ->join("products", "order_infos.product_id", "=", "products.id")
            ->where("order_infos.order_id", $id)
            ->select(["order_infos.*", "products.name"])
            ->get();
    }
}
