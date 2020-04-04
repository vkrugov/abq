<?php

namespace App\Http\Middleware\api;

use App\User;
use Closure;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class CheckUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = User::find($request->userId);

        if ($user !== null && $user->token !== $request->userToken) {
            throw new UnprocessableEntityHttpException('User token not valid');
        }

        return $next($request);
    }
}
