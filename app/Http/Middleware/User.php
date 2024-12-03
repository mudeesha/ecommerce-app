<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class User
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is authenticated and of type 'user'
        if (!Auth::check() || Auth::user()->usertype != 'user') {
            // Redirect to a default page or display an error
            return redirect('/')->withErrors('Access denied.');
        }

        return $next($request);
    }
}
