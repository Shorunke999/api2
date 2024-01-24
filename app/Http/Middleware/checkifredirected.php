<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class checkifredirected
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
         $referrer = $request->headers->get('referer');

         // Check if the referring URL is from the same domain
         if ($referrer && strpos($referrer, config('app.url')) === 0) {
             return $next($request);
         }
         return abort(403, 'Unauthorized. Access not granted from another page.');
     }
}

