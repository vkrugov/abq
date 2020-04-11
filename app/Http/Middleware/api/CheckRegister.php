<?php

namespace App\Http\Middleware\api;

use App\Enums\GenderEnum;
use Closure;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class CheckRegister
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
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'phone' => 'required',
            'birthday_at' => 'required',
            'email' => 'required|email|unique:user',
            'gender' => 'required|in:' . implode(',', GenderEnum::toArray()),
            'password' => 'required|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()->getMessages(),
                ]);
        }

        return $next($request);
    }
}
