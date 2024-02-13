<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function switchLanguage(Request $request, $locale)
    {
        // Verificar que el idioma proporcionado esté permitido
        if (! in_array($locale, ['en', 'es'])) {
            abort(400);
        }
        
        // Guardar el idioma en la sesión
        $request->session()->put('locale', $locale);

        // Redirigir de regreso a la página anterior
        return back();
    }
}
