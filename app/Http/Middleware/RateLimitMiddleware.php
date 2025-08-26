<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Log;

class RateLimitMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string  $key
     * @param  int  $maxAttempts
     * @param  int  $decayMinutes
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $key = 'global', $maxAttempts = 40, $decayMinutes = 1)
    {
        $rateLimitKey = $this->resolveRequestSignature($request, $key);

        if (RateLimiter::tooManyAttempts($rateLimitKey, $maxAttempts)) {
            Log::warning('Rate limit exceeded', [
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'url' => $request->fullUrl(),
                'key' => $rateLimitKey
            ]);

            return response()->json([
                'message' => 'Too many requests. Please try again later.',
                'retry_after' => RateLimiter::availableIn($rateLimitKey)
            ], 429);
        }

        RateLimiter::hit($rateLimitKey, $decayMinutes * 60);

        $response = $next($request);

        // Add rate limit headers
        $response->headers->add([
            'X-RateLimit-Limit' => $maxAttempts,
            'X-RateLimit-Remaining' => RateLimiter::remaining($rateLimitKey, $maxAttempts),
            'X-RateLimit-Reset' => RateLimiter::availableIn($rateLimitKey) + time(),
        ]);

        return $response;
    }

    /**
     * Resolve the rate limiting signature for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $key
     * @return string
     */
    protected function resolveRequestSignature(Request $request, $key)
    {
        if ($key === 'ip') {
            return 'rate_limit:' . $request->ip();
        }

        if ($key === 'user') {
            return 'rate_limit:user:' . ($request->user()->id ?? $request->ip());
        }

        if ($key === 'login') {
            return 'rate_limit:login:' . $request->ip();
        }

        return 'rate_limit:' . $key . ':' . $request->ip();
    }
}
