<?php

namespace App\Http\Middleware;

use App\Models\Center;
use Spatie\Permission\Exceptions\UnauthorizedException;

use Closure;

class MyPermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $permission, $center_id)
    {
        // dd($permission, $center);
        if (app('auth')->guest())
        {
            throw UnauthorizedException::notLoggedIn();
        }

        $user = app('auth')->user();

        if($user->isSuperAdmin())
        {
            return $next($request);
        }

        $permissions = is_array($permission)
            ? $permission
            : explode('|', $permission);

        if ($user->hasap($center_id, $permissions))
        {
            return $next($request);
        }

        throw UnauthorizedException::forPermissions($permissions);
    }
}
