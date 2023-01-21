<?php

namespace App\Http\Controllers;

use App\Http\Requests\BrandRequest;
use App\Models\ActionLog;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Http\Request;

class BrandController extends AdminController
{
    public function __construct(private Brand $brand, ActionLog $actionLog)
    {
        parent::__construct($actionLog);
        $this->brand = new Brand();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("admin.pages.brands", [
            "adminNav" => $this->data["adminNav"],
            "brands" => $this->brand->allBrands()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BrandRequest $request)
    {
        $name = $request->get("name");
        try {
            $this->brand->addBrand($name);
            $this->logAction("Admin added ".$name." brand", $request);
            return response()->json(true);
        }
        catch (\Exception $exception){
            \Log::error(uniqid()." ".$exception->getMessage());
            return response()->json("Sorry we had an server error");
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BrandRequest $request, $id)
    {
        try{
            $this->brand->editBrand($id, $request->get("name"));
            $this->logAction("Admin edited brand name to".$request->get("name"), $request);
            return response()->json(true);
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
        if ($request->has("btn")){
            if(Product::where("brand_id", $id)->count()){
                $this->logAction("Admin could not delete a brand due to restrictions", $request);
                return response()->json(false);
            }
            $this->brand::destroy($id);
            $this->logAction("Admin deleted a brand", $request);
            return response()->json(true);
        }
    }
}
