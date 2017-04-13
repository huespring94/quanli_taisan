<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Role;

class FacultyMiddleware
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
        if (Auth::user()->role->name !== Role::ROLE_FACULTY) {
            return redirect('login');
        }
        return $next($request);
    }
}
