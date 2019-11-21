<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Facade;
use Illuminate\Cookie\CookieJar;
use Illuminate\Routing\ResponseFactory;
use App\Language;



class LocalizationController extends Controller
{
    public function index($locale)
    {
        $minutes = 3000;
        $lang = Language::where('code_language', '=', $locale)->get();
        if($lang == null) {
            $locale = Lang::getLocale();
        }
        // dd($lang);
        App::setLocale($locale);
        setcookie("locale", $locale, time()+3600, "/"); 
        // dd(Cookie::get('locale'));
        return redirect()->back();
    }
}
