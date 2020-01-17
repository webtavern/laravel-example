<?php


namespace AttendanceSystem\Http\Middleware;


use Closure;
use Illuminate\Support\Facades\Request;

class RouteMiddleware
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
        $user = auth()->user();

        $route = Request::route()->getName();

        if (!$user->hasRole('admin')) {

            $user_permissions = $user->permissions()->get();

            $user_routes = [];

            foreach ($user_permissions as $permission) {
                $user_routes[] = json_decode($permission->routes);
            }

            if (!in_array($route, $user_routes)) {
                abort(403);
            }

        }

        return $next($request);
    }
}
