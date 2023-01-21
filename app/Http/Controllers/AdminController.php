<?php

namespace App\Http\Controllers;

use App\Http\Requests\DateRequest;
use App\Models\ActionLog;
use App\Models\Nav;
use Illuminate\Http\Request;

class AdminController extends BaseController
{
    public function __construct(ActionLog $actionLog)
    {
        parent::__construct($actionLog);
        $this->data["adminNav"] = (new Nav())->adminNav();
    }

    public function adminIndex(Request $request)
    {
        if($request->has("from") || $request->has("to")){
            if(strtotime($request->get("from")) > strtotime($request->get("to"))) {
                return redirect()->back()->with(["afterErr" => "'from' date can't be after 'to' date"]);
            }
        }
//        dd($this->actionLog->getActions($request));
        return view("admin.pages.index", [
            "adminNav" => $this->data["adminNav"],
            "actions" => $this->actionLog->getActions($request)
        ]);
    }
}
