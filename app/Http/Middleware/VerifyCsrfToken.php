<?php

namespace App\Http\Middleware;

use Closure;
use App;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        //
    ];

    public function handle($request, Closure $next)
    {
        if ($request->input('_token') && !$this->tokensMatch($request)) {

            if ($request->ajax()) {
                App::abort(400, 'Token mismatch');
            }

            return redirect()->back()->withErrors(['Token mismatch']);;
        }

        return $next($request);
    }
}
