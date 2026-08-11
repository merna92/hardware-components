<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class LocaleController extends Controller
{
    public function setLocale($locale)
    {
        if (in_array($locale, ['en', 'ar'])) {
            session(['locale' => $locale]);
            
            // Also store in a cookie for 1 year as backup
            $cookie = cookie('locale', $locale, 60 * 24 * 365);
            
            return redirect()->back()->withCookie($cookie);
        }
        
        return redirect()->back();
    }
}
