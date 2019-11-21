<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Facade;
use App;
use Lang;

class Localization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // dd(Cookie::get('locale'));
        if(!isset($_COOKIE['locale'])) {
            $locale = Lang::getLocale();
            App::setLocale($locale);
            setcookie("locale", $locale, time()+3600, "/"); 
        }else{
            App::setLocale($_COOKIE['locale']);
        }
        // if (Cookie::get('locale') !== false) {
        //     App::setLocale($_COOKIE['locale']);
        // }
        return $next($request);
    }
}
