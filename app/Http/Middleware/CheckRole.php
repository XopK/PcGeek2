<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */

    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (auth()->check()) {
            $user = auth()->user();

            foreach ($roles as $role) {
                if ($user->role()->where('title_role', '=', $role)->exists()) {
                    return $next($request);
                }
            }
        }

        abort(403, 'У вас недостаточно прав!');
    }
}
