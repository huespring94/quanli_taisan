<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;

class RoomMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request []
     * @param \Closure                 $next    []
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::user()->role->name !== Role::ROLE_ROOM) {
            return redirect('login');
        }
        return $next($request);
    }
}
