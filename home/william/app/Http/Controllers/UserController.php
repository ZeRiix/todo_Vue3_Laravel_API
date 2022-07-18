<?php

namespace App\Http\Controllers;


use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function Userlogin(Request $request)
    {
        $request->validate([
            'email'=> 'string|required',
            'password'=> 'string|required',
        ]);
        $user = $this->userService->loginUser($request);
        return response()->json([$user]);
    }

    public function Usercreate(Request $request)
    {
        $request->validate([
            'name'=> 'string|required',
            'email'=> 'string|required|email',
            'password'=> 'string|required',
        ]);

        $user = $this->userService->createUser($request);
        return response()->json([$user]);
    }

}
