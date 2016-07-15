<?php

namespace App\Http\Middleware;


use Illuminate\Http\Request;

use Closure;


class ThirdPartyAccess
{
    public function handle($request, Closure $next)
    {
        $accessToken = config('third_party.access_token');
        $accessTokenProvided = request()->header('access_token');

        if ($accessTokenProvided === $accessToken) {
            return $next($request);
        }

        return response()->json(['message' => 'Not allowed.'], 403);
    }
}

