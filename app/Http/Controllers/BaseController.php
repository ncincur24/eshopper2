<?php

namespace App\Http\Controllers;

use App\Models\ActionLog;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    protected array $data;

    public function __construct(protected ActionLog $actionLog)
    {
        $this->actionLog = new ActionLog();
    }

    protected function logAction($action, Request $request) {
        $ip = $request->ip();
        $path = $request->path();
        $method = $request->method();
//        $user_id = $request->session()->has("user") ? $request->session()->get("user")->id : $user_id;
        try {
            $this->actionLog->markAction($ip, $path, $method, $action);
        } catch(\Exception $ex) {
            \Log::error($ex->getMessage());
        }
    }
}
