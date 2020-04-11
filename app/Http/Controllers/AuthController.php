<?php

namespace App\Http\Controllers;

use App\Enums\RoleEnum;
use App\helpers\UserHelper;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Contracts\Providers\Auth;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'registration']]);
    }

    public function registration(Request $request)
    {
        $user = new User();
        $user->first_name = $request->first_name;
        $user->first_name = $request->first_name;
        $user->email = $request->email;
        $user->phone= preg_replace("/[^0-9]/", '', $request->phone);
        $user->last_name = $request->last_name;
        $user->birthday_at = strtotime($request->birthday_at);
        $user->password = Hash::make($request->password);
        $user->role_id = RoleEnum::CUSTOMER;
        $user->gender_id = $request->gender;

        $user->save();

        $token = auth()->attempt(request(['email', 'password']));

        return response()->json([
            'user' => UserHelper::getInfo(auth()->user()),
            'token' => $token,
        ]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = request(['email', 'password']);

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return response()->json([
            'user' => UserHelper::getInfo(auth()->user()),
            'token' => $token,
        ]);

    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me(Request $request)
    {
        return response()->json(UserHelper::getInfo(auth()->user()));
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Get the token array structure.
     *
     * @param string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $this->guard()->factory()->getTTL() * 60
        ]);
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\Guard
     */
    public function guard()
    {
        return Auth::guard();
    }
}
