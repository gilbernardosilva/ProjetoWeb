<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class isAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();

            if ($user->role == 'admin') {
                return $next($request);
            }
            if ($request->route('product')) {
                if ($user->id == $request->route('product')->user_id) {
                    return $next($request);
            }
            return redirect('/home')->with('error', 'You dont have access to this page');
        }
    }
}
