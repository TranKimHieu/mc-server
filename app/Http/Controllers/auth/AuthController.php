<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
    /**
     * @var bool
     */
    public $loginAfterSignUp = true;

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $input = $request->only('email', 'password');
        $token = null;

        if (!$token = Auth::attempt($input)) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid Email or Password',
            ], 401);
        }

        return response()->json(['user' => Auth::user(), 'token' => $token]);
    }

    public
    function logout()
    {
        try {
            Auth::logout();

            return response()->json([
                'status' => true,
                'message' => 'User logged out successfully'
            ]);
        } catch (JWTException $exception) {
            return response()->json([
                'status' => false,
                'message' => 'Sorry, the user cannot be logged out'
            ], 500);
        }
    }

    public
    function me()
    {
        return response()->json(Auth::user());
    }
}
