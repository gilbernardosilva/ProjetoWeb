<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAccessMiddleWare
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        $user = Auth::user();
        if($request->route('user')){
            if ($user->id == $request->route('user')->id || $user->role == 'admin') {
                return $next($request);
            }
        }
        else{
            if($user->role == 'admin'){
                return $next($request);
            }
        }
        return redirect('/dashboard')->with('error','You dont have access to this page');
    }
}
