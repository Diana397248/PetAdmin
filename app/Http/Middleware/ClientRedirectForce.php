<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ClientRedirectForce
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
//        if (Auth::user() &&
//            Auth::user()->role === 'client') {
//            if ($request->isMethod('GET') &&
//                !(
//                    str_contains($request->path(), 'cabinet') ||
//                    str_contains($request->path(), 'register') ||
//                    str_contains($request->path(), 'login') ||
//                    str_contains($request->path(), 'logout')
//                )) {
//                return redirect("/");
//            }
//        }
        return $next($request);
    }
}
