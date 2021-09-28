<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {

        if ($role == 'admin' && auth()->user()->type != 'admin') {

            return abort(403);

        } elseif($role == 'employee' && auth()->user()->type != 'employee') {

            return abort(403);
        } elseif($role == 'candidate' && auth()->user()->type != 'candidate') {

            return abort(403);
    }
        return $next($request);
    }
}
