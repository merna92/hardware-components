<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    public function handle(Request $request, Closure $next): Response
    {
        // Check session first, then cookie fallback
        $locale = session('locale') ?? $request->cookie('locale') ?? 'en';
        
        if (in_array($locale, ['en', 'ar'])) {
            App::setLocale($locale);
            
            // Sync session if only cookie had the value
            if (!session('locale') && $request->cookie('locale')) {
                session(['locale' => $locale]);
            }
        }

        return $next($request);
    }
}
