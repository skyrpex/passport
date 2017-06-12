<?php

namespace Laravel\Passport\Http\Middleware;

use Illuminate\Auth\AuthenticationException;
use Laravel\Passport\Exceptions\MissingScopeException;

class CheckForAnyScope
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  array  $scopes
     * @return \Illuminate\Http\Response
     */
    public function handle($request, $next)
    {
        if (! $request->user() || ! $request->user()->token()) {
            throw new AuthenticationException;
        }

        $scopes = array_slice(func_get_args(), 2);
        foreach ($scopes as $scope) {
            if ($request->user()->tokenCan($scope)) {
                return $next($request);
            }
        }

        throw new MissingScopeException($scopes);
    }
}
