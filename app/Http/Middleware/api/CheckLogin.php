<?php

namespace App\Http\Middleware\api;

use App\Enums\GenderEnum;
use App\User;
use Closure;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CheckLogin
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|between:6,25',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ]);
        }

        $user = User::whereEmail($request->email)->first();

        if (!$user || Hash::check($request->password, $user->password) === false) {
            return response()->json([
                'success' => false,
                'errors' => 'email or password is invalid'
                ]);
        }

        return $next($request);
    }
}
