<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ApiMiddleware
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
        $token = $request->token;
        if (empty($token)) {
            return response()->error('Unauthorized.', 401);
        }

        if (!$this->checkToken($token)) {
            return response()->error('Invalid token', 401);
        }

        return $next($request);
    }

    /**
     * @return [type]
     */
    private function token()
    {
        return "2y10OzIb3GbtEXSB5dSgsspmulLK0Y5dpmhTDT97VeBAY94GgEAO";
    }

    /**
     * @param mixed $token
     *
     * @return [type]
     */
    public function checkToken($token)
    {
        if ($token == $this->token()) {
            return true;
        }
        return false;
    }
}
