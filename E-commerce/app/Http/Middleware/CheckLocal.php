<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckLocal
{
    public function handle(Request $request, Closure $next)
    {
        // Aquí puedes implementar la lógica para detectar y establecer el idioma de la aplicación
        $locale = $request->session()->get('locale', config('app.locale'));

        app()->setLocale($locale);

        return $next($request);
    }
}
