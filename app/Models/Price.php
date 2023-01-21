<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Price
 *
 * @property int $id
 * @property float $amount
 * @property int $product_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Price newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Price newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Price query()
 * @method static \Illuminate\Database\Eloquent\Builder|Price whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Price whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Price whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Price whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Price whereUpdatedAt($value)
 * @mixin \Eloquent
 * @method static \Database\Factories\PriceFactory factory(...$parameters)
 */
class Price extends Model
{
    use HasFactory;
    protected $guarded  = [];
    public function singlePrice($id)
    {
        $this::where("id",$id)->max("id");
    }

    public function addPrice($price, $id)
    {
        $this::create([
           "amount" =>  $price,
           "product_id" => $id
        ]);
    }

    public function productInPrices($id)
    {
        return $this::where("product_id", $id)->select("prices.id")->get();
    }
}
