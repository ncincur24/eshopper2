<?php

namespace App\Http\Controllers;

use App\Http\Requests\LogUserRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Models\ActionLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use PHPUnit\Exception;

class AuthController extends BaseController
{
    public function __construct(private User $user, ActionLog $actionLog)
    {
        parent::__construct($actionLog);
        $this->user = new User();
    }

    public function login()
    {
        return view("pages.login");
    }

    public function registration()
    {
        return view("pages.registration");
    }

    public function registrationAction(Request $request, RegisterUserRequest $registerUserRequest)
    {
        if ($request->ajax() && $request->method() == "POST" && $request->has("btn") ){
            try {
                $name = $request->input("name");
                $last_name = $request->input("last_name");
                $email = $request->input("email");
                $password = Hash::make(($request->input("password")));

                $this->user->registerUser($name, $last_name, $email, $password);
                $this->logAction("User registered", $request);
                return response()->json([
                    "end" => true,
                    "route" => route("login")
                ]);
            }
            catch (Exception $exception){
                \Log::error(uniqid()." ".$exception->getMessage());
                return response()->json("Sorry we had an server error");
            }
        }
    }

    public function loginAction(LogUserRequest $request)
    {
        if ($request->ajax() && $request->method() == "POST" && $request->has("btn") ){
            try {
                $email = $request->input("email");
                $password = $request->input("password");
                $userLog = $this->user->logInUser($email, $password);
                if ($userLog->active == 1){
                    return response()->json([
                        "email" => "This account is not active or banned",
                        "pass" => false
                    ]);
                }
                else if (Hash::check($password, $userLog->password)) {
                    if($userLog){
                        $request->session()->put("user", $userLog);
                        $route = route("home");
                        if($userLog->id == 1) {
                            $route = route("admin.home");
                            $this->logAction("Admin logged in", $request);
                        }
                        else{
                            $this->logAction("User logged in", $request);
                        }
                    }
                        return response()->json([
                            "name" => $userLog->name,
                            "pass" => true,
                            "route" => $route
                        ]);
                }
                return response()->json(["password" => "Incorrect password"]);
            }
            catch (Exception $exception){
                \Log::error(uniqid()." ".$exception->getMessage());
                return response()->json("Sorry we had an server error");
            }
        }
    }

    public function logout(Request $request)
    {
        if(session()->get("user")->role_id == 1){
            $this->logAction("Admin logged out", $request);
        }
        else{
            $this->logAction("User logged out", $request);
        }
        $request->session()->forget("user");
        $request->session()->flush();
        return redirect()->route("home");
    }
}
