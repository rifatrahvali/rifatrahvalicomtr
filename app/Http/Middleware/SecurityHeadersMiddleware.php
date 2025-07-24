<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SecurityHeadersMiddleware
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
        $response = $next($request);
        // Content Security Policy (CSP)
        $response->headers->set('Content-Security-Policy',
            "default-src 'self'; img-src 'self' data:; script-src 'self' 'unsafe-inline'; style-src 'self' 'unsafe-inline'; object-src 'none'; frame-ancestors 'none'; base-uri 'self'; form-action 'self';"
        );
        // X-Frame-Options
        $response->headers->set('X-Frame-Options', 'DENY');
        // X-XSS-Protection
        $response->headers->set('X-XSS-Protection', '1; mode=block');
        // Referrer-Policy
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');
        // X-Content-Type-Options
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        // Türkçe: Bu middleware, temel güvenlik header'larını tüm response'lara ekler.
        return $response;
    }
} 