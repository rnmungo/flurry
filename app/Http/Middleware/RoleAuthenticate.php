<?php

namespace Flurry\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $resource)
    {
        switch ($resource) {
            case 'settings':
                if (Auth::user() && !Auth::user()->hasAnyRole(['Admin'])) {
                    abort(403);
                }
                break;
            case 'customers':
                if (Auth::user() && !Auth::user()->hasAnyRole(['Admin', 'Manager', 'Supervisor', 'Operator'])) {
                    abort(403);
                }
                break;
            case 'cadets':
                if (!$request->ajax() && Auth::user() && !Auth::user()->hasAnyRole(['Admin', 'Manager', 'Supervisor'])) {
                    abort(403);
                }
                break;
            case 'products':
                if (!$request->ajax() && Auth::user() && !Auth::user()->hasAnyRole(['Admin', 'Manager', 'Supervisor'])) {
                    abort(403);
                }
                break;
            case 'roles':
                if (Auth::user() && !Auth::user()->hasAnyRole(['Admin', 'Manager', 'Supervisor', 'Operator'])) {
                    abort(403);
                }
                break;
            case 'tastes':
                if (!$request->ajax() && Auth::user() && !Auth::user()->hasAnyRole(['Admin', 'Manager', 'Supervisor'])) {
                    abort(403);
                }
                break;
            case 'users':
                if (Auth::user() && !Auth::user()->hasAnyRole(['Admin'])) {
                    abort(403);
                }
                break;
        }
        return $next($request);
    }
}
