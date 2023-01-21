<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddProductRequest;
use App\Http\Requests\ProductRequest;
use App\Models\ActionLog;
use App\Models\Brand;
use App\Models\Image;
use App\Models\Nav;
use App\Models\Price;
use App\Models\Product;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PHPUnit\Exception;

class ProductsController extends BaseController
{
    public function __construct(private Product $product, private Brand $brand, private Image $image, private Price $price, ActionLog $actionLog)
    {
        parent::__construct($actionLog);
        $this->product = new Product();
        $this->brand = new Brand();
        $this->image = new Image();
        $this->price = new Price();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function adminIndex(Request $request)
    {
        return view("admin.pages.products", [
            "adminNav" => Nav::where("show", 1)->get(),
            "products" => $this->product->allProducts($request, true)
        ]);
    }

    public function index(Request $request)
    {
//        if($request->ajax()){
//            return response()->json([
//                "products" => $this->product->allProducts($request),
//                "brands" => $this->brand->allBrands(),
//                "types" => $this->type->allTtypes()
//            ]);
//        }
//        else{
            $checkedBrands = $request->get("brands") ? $request->get("brands") : [];
            $checkedTypes = $request->get("types") ? $request->get("types") : [];
            $sort = $request->get("sort");
            $word = $request->input("keyword");

            return view("pages.products", [
                "sort" => $sort,
                "word" => $word,
                "products" => $this->product->allProducts($request),
                "brands" => $this->brand->allBrands(),
                "checkedBrands" => $checkedBrands,
                "checkedTypes" => $checkedTypes
            ]);
//        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.pages.add-product", [
            "brands" => $this->brand->allBrands(),
            "adminNav" => Nav::where("show", 1)->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        try {
            $data = $request->all();
            $image = $request->file("image");


            $fileName = uniqid()."_".time().".".$image->extension();
            $image->storeAs("public/img", $fileName);

            $data["image"] = $fileName;
            DB::transaction(function () use ($data){
                $id = $this->image->addImage($data["image"]);
                $product = $this->product->addProduct($data, $id->getAttribute("id"));
                $this->price->addPrice($data["price"], $product->getAttribute("id"));
            });
            $this->logAction("Admin new product ".$data["name"], $request);
            return redirect()->back()->with(["added" => "Product added successfully"]);
        }
        catch (\Exception $exception){
            \Log::error("An error ocurred ".$exception->getMessage());
            return response()->redirectToRoute("error");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view("pages.detail", [
            "product" => $this->product->singleProduct($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view("admin.pages.single", [
            "product" => $this->product->singleProduct($id),
            "adminNav" => Nav::where("show", 1)->get(),
            "brands" => $this->brand->allBrands()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $data = $request->all();
        try{
            DB::transaction(function () use ($data, $id){
                $this->product->editProduct($data, $id);
                $this->price->addPrice($data["price"], $id);
            });
            $this->logAction("Admin edited a product", $request);
            return response()->json([
                "end" => true,
                "route" => route("admin.products")
            ]);
        }
        catch (\Exception $exception){
            \Log::error(uniqid()." ".$exception->getMessage());
            return response()->json("Sorry we had an server error");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        try{
            if ($request->has("btn")){
                $this->product->softDeleteProduct($id);
                $this->logAction("Admin soft-deleted a product", $request);
                return response()->json(true);
            }
        }
        catch (Exception $exception){
            \Log::error(uniqid()." ".$exception->getMessage());
            return response()->json("Sorry we had an server error");
        }

    }
}
