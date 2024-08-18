<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckStatusMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if ($user) {

            // valida que la cuenta del usuario este activa
            if ($user->status != ACTIVO) {
                Auth::logout();
                abort(403, 'Tu cuenta ha sido desactivada.');
            }

            // valida que la empresa este activa
            if ($user->company->status != ACTIVO) {
                Auth::logout();
                abort(403, 'Tu empresa esta inactiva, Contacta al administrador para más información');
            }

            // valida que la licencia de la empresa este vigente
            if ($user->company && Carbon::now()->greaterThan($user->company->end_license)) {
                Auth::logout();
                abort(403, 'Tu empresa no tiene la licencia activa. Contacta al administrador para más información');
            }
        }

        return $next($request);
    }
}
