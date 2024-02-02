<?php

namespace App\Http\Middleware;

use App\Exceptions\MainException;
use App\HelperClasses\MyApp;
use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;

class userCheckAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = user();
        if (is_null($user)){
            throw new AuthenticationException();
        }
        if (!$user->is_active) {
            throw new MainException("this user is currently not active");
        }
        return $next($request);
    }
}
