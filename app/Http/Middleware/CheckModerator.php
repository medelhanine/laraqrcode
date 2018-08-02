<?php

namespace App\Http\Middleware;

use Flash;
use Auth;
use Closure;

class CheckModerator
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
        if(Auth::user()->role_id > 2 )
        {
            Flash::error('Sorry you have no permission to view this ');
            return redirect('/home');
        }
        return $next($request);
    }
}
