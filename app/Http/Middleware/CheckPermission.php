<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string[]  ...$permissions
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$permissions)
    {
        $user = Auth::user();
        $userHasPermission = $user->hasAnyPermission($permissions);

        if (!$user || !$userHasPermission) {
            abort(403, 'Unauthorized action.');
        }
        return $next($request);
    }
}
