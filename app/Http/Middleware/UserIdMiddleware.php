<?php


namespace AttendanceSystem\Http\Middleware;


use Closure;

class UserIdMiddleware
{
    /**
     * Handle an incoming request.
     * @param $request
     * @param Closure $next
     * @param $role
     * @param null $permission
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!auth()->user()->hasRole('admin')) {
            if(array_key_exists('user', $request->route()->parameters())) {
                if($request->user->id !== auth()->user()->id) {
                    abort(403);
                }
            }
        }

        return $next($request);
    }
}
