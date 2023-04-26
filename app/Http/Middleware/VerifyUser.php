<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class VerifyUser
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
        $user = auth()->user();
        if($user) {
            if ($user->email_verified_at == null || $user->email_verified_at == '') {
                auth()->logout();
                return redirect()->route('verifyEmail')->with('user', $user);
            } else {
                return $next($request);
            }
        } else {
            // auth()->logout();
            return redirect()->route('login')->with('error', 'User not found, please check the email id and password to make sure you entered correctly.');
        }
    }
}
