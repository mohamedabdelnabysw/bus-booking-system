<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        $user = User::where($request->validated())->first();
        $token = $user->createToken('login_token');
        return response()->json([
            'user' => $user,
            'token' => $token->plainTextToken
        ]);
    }
}
