<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

/**
 * App\Models\Product
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $brand_id
 * @property int $img_id
 * @property int $type_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\ProductFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product query()
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereBrandId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereImgId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property float $current_price
 * @property int $visible
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Query\Builder|Product onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCurrentPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereVisible($value)
 * @method static \Illuminate\Database\Query\Builder|Product withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Product withoutTrashed()
 */
class Product extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];
    public function allProducts(Request $request, bool $admin = false)
    {
        //with eloquent
        $query = $this->join("brands", "products.brand_id","=","brands.id");
        $query = $query->join("images", "products.img_id","=","images.id");

        //WHERE
        if($request->has("brands")){
            $query = $query->whereIn("products.brand_id", $request->get("brands"));
        }
        if($request->has("keyword")){
            $query = $query->where("products.name", "like", "%".$request->get("keyword")."%");
        }


        //SELECT
        $query = $query->select(["products.*", "brands.name AS brand_name", "images.src", "images.alt"]);

        //ORDER BY
        if($request->get("sort") == 1){
            $query = $query->orderBy("products.current_price");
        }
        else if($request->get("sort") == 2){
            $query = $query->orderByDesc("products.current_price");
        }
        else if($request->get("sort") == 3){
            $query = $query->orderBy("products.name");
        }
        else if($request->get("sort") == 4){
            $query = $query->orderByDesc("products.name");
        }
        else{
            $query = $query->orderBy("products.id");
        }

        if($admin){
            return $query->get();
        }
        return $query->paginate(3)->appends([
            "brands" => $request->get("brands"),
            "keyword" => $request->get("keyword"),
            "sort" => $request->get("sort")
        ]);
    }

    public function singleProduct($id)
    {
        return $this->join("brands", "products.brand_id","=","brands.id")
                    ->join("images", "products.img_id","=","images.id")
                    ->select(["products.*", "brands.name AS brand_name", "images.src", "images.alt"])
                    ->where("products.id",$id)
                    ->first();

    }

    public function addProduct(array $data, $img)
    {
        return $this::create([
           "name" => $data["name"],
           "current_price" => $data["price"],
           "img_id" => $img,
           "brand_id" => $data["brand"],
           "description" => $data["description"]
        ]);
    }

    public function editProduct(array $data, $id)
    {
        $product = $this::find($id);
        $product->name = $data["name"];
        $product->description = $data["description"];
        $product->current_price = $data["price"];
        $product->brand_id = $data["brand"];
        $product->save();
    }

    public function softDeleteProduct($id)
    {
        $this::destroy($id);
    }

    public function newsestProducts()
    {
        return $this->join("brands", "products.brand_id","=","brands.id")
                    ->join("images", "products.img_id","=","images.id")
                    ->select(["products.*", "brands.name AS brand_name", "images.src", "images.alt"])
                    ->take(4)
                    ->orderByDesc("id")
                    ->get();
    }
}
