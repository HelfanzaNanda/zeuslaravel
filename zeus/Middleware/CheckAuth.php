<?php

namespace Zeus\Middleware;

use Closure;
use Session;
use Zeus\Libraries\ZeusUser;

class CheckAuth
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
        $auth = new ZeusUser();
        if ($auth->has_login()) {
            return $next($request);
        } else {
            return redirect()->route('login')->with('error', 'You must login first!');
        }
    }
}
