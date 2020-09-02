<?php

namespace Zeus\Middleware;

use Closure;
use Session;
use Zeus\Libraries\ZeusUser;
use Illuminate\Support\Facades\Crypt;

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
            $route_name = $request->route()->getName();
            if($auth->check_access_route($route_name))
            {
                return $next($request);
            }else{
                return redirect()->route('core.account.dashboard')->with('error', 'Not Authentication');
            }
        } else {
            $prev_uri_segments = $request->segments();
            $implode=implode("/",$prev_uri_segments);
            if(empty($implode))
            {
                return redirect()->route('login')->with('error', 'You must login first!');
            }else{
                $encrypt = Crypt::encryptString($implode);
                Session::put('redirect',$implode);
                return redirect()->route('login', ['pipeline' => $encrypt])->with('error', 'You must login first!');
            }
        }
    }
}
