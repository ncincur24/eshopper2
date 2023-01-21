<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Order
 *
 * @property int $id
 * @property string $address
 * @property float $total_price
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Order newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order query()
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereTotalPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereUserId($value)
 * @mixin \Eloquent
 */
class Order extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function createOrder($address, $price)
    {
        return $this::create([
            "address" => $address,
            "total_price" => $price,
            "user_id" => session()->get("user")->id
        ]);
    }

    public function getOrderedItems()
    {
        return $this
            ->where("orders.user_id", session()->get("user")->id)
            ->get();
    }

    public function allOrders()
    {
        return $this->join("users", "orders.user_id", "=", "users.id")
                    ->select(["orders.*", "users.full_name", "users.email"])
                    ->get();
    }
}
