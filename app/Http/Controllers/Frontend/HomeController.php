<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use Lang;
use App\Language;
use App\Localization;
use DB;
use App;

class HomeController extends Controller
{

    public function index() {

        $locale = App::getLocale();
        // $posts = Post::all();
        $idLanguage = Language::where('code_language', '=', $locale)->first();
        // dd($idLanguage);
        $posts = Language::find($idLanguage->id)->posts()->get();
        // foreach ($posts as $key) {
        //     echo $key;
        //     echo "</br>";
        //     echo "------------------------------------------------";
        //     echo "</br>";
        //     echo "</br>";
        //     echo "</br>";
        //     echo "</br>";
        // }
        // exit;
        return view('frontend.index', compact('posts'));
    }

    public function show($slug){

        $locale = App::getLocale();
        // $new = Language::find(Localization::$localeArray[$_COOKIE['locale']])->take(10)->get();
        $language = Language::where('code_language', '=', $locale)->first();
        // dd($language);
        // $lang = Language::find($idLanguage->id);
        // $new = Post::all();
        $lasted = $language->posts()->get();
        // dd($lasted  );
        // foreach ($new as $postNew) {
        //     if($postNew->languages()->find($idLanguage->id) != null) {
        //         $lasted[] = $postNew->languages()->find($idLanguage->id);
        //         dd($lasted);
        //     }
        // }
        // dd($lasted);
        // $lasted = $new->langages()->where('language_id', Localization::$localeArray[$_COOKIE['locale']]);
        // dd($lasted);
        // $idLanguage = Language::where('code_language', '=', $this->locale)->first();
        // $lang = Language::find($idLanguage->id);
        // ------ slug ----- $post = Post::where('slug', '=', $slug)->first();
        $post = Post::find($slug);
        $post = $language->posts()->find($post->id);
        // $post = $language->posts()->where('slug', '=', $slug);
        // print_r($lasted);exit;
        // var_dump($lasted);exit;
        // dd($post);
        if($post != null){
            return view('frontend.post', compact('post', 'lasted'));
        }
        return redirect()->route('home.index');
    }
}
