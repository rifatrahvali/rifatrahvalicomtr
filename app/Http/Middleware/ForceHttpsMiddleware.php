<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ForceHttpsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Eğer istek HTTPS değilse, HTTPS'e yönlendir
        if (!$request->secure()) {
            return redirect()->secure($request->getRequestUri());
        }
        // HSTS header ekle (1 yıl boyunca sadece HTTPS)
        $response = $next($request);
        $response->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains');
        return $response;
        // Türkçe: Bu middleware, tüm istekleri HTTPS'e yönlendirir ve HSTS header ekler.
    }
} 