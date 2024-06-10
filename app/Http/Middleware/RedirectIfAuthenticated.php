<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $authenticatable = Auth::user();
                if ($authenticatable) {
                    $userRole = $authenticatable->role;
                    if ($userRole === 'admin') {
                        return redirect("/clients");
                    } elseif ($userRole === 'doctor')
                        return redirect("/appointments");
                    else
                        return redirect("/cabinet");
                }
                return redirect("/cabinet/home");
            }
        }

        return $next($request);
    }
}
