<?php

namespace App\Http\Middleware;

use App\Http\Requests\Request;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class admin
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
        if(!(Auth::check()&& Auth::user()->isAdmin()))
        {
            return Redirect('/home');
        }
        return $next($request);
    }
}

/*if(!(Auth::check()&& Auth::user()->isAdmin()))
{
    return Redirect('/home');
}



public function handle($request, Closure $next, $guard = null)
{
    if (Auth::guard($guard)->guest()) {
        if ($request->ajax() || $request->wantsJson()) {
            return response('Unauthorized.', 401);
        } else {
            return redirect()->guest('login');
        }
    }

    return $next($request);
}

if(Auth::guest())
{
    if(Request::ajax())
    {
        return Response::make('Unauthorized', 401);
    }
    else
    {
     return Redirect::guest('login');
    }
}*/