<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class Authenticate
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!Session::has('auth.user')) {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest('au/login')
                    ->withErrors(['Login to continue']);
            }
        }

        return $next($request);
    }
}
