<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\ActionLog;
use App\Models\Message;
use App\Models\Nav;
use Illuminate\Http\Request;
use PHPUnit\Exception;

class ContactController extends BaseController
{
    public function __construct(private Message $message, ActionLog $actionLog)
    {
        parent::__construct($actionLog);
        $this->message = new Message();
    }

    public function index()
    {
        return view("pages.contact");
    }

    public function sendMessage(ContactRequest $request)
    {
        try {
            $this->message->sendMessage($request->all());
            $this->logAction("Client sent message", $request);
            return response()->json(true);
        }
        catch (Exception $exception){
            \Log::error(uniqid()." ".$exception->getMessage());
            return response()->json("Sorry we had an server error");
        }
    }

    public function listMessages()
    {
        return view("admin.pages.messages", [
            "adminNav" => Nav::where("show", 1)->get(),
            "messages" => $this->message->allMessaget()
        ]);
    }
}
