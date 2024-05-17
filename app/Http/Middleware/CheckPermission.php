<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if (!$user) {
            abort(403, 'Unauthorized action.');
        }

        $routeName = $request->route()->getName();

        $permission = $this->getPermissionBasedOnRouteName($routeName);

        if (!empty($permission) && !$this->userHasPermission( $user, $permission)) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }

    /**
     * Get the permission required based on the route name.
     *
     * @param  string  $routeName
     * @return string|null
     */
    protected function getPermissionBasedOnRouteName($routeName)
    {
        $map = [
            'index' => 'view',
            'show' => 'view',
            'create' => 'create',
            'store' => 'create',
            'edit' => 'edit',
            'update' => 'edit',
            'destroy' => 'delete',
            'trash' => 'view',
            'restore' => 'restore',
            'forceDestroy' => 'forceDestroy',
            'search' => 'view',
            // Add more mappings as needed
        ];

        $routeName = explode('.', $routeName)[1];

        return $map[$routeName] ?? null;
    }

    /**
     * Check if the user has the specified permission.
     *
     * @param  \App\Models\User  $user
     * @param  string  $permission
     * @return bool
     */
    protected function userHasPermission($user, $permission)
    {
        foreach ($user->roles as $role) {
            if ($role->permissions()->where('name', $permission)->exists()) {
                return true;
            }
        }
        return false;
    }
}
