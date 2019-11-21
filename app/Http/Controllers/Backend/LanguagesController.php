<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;
use App\Language;
use App\Localization;
use App;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Route;

class LanguagesController extends Controller
{
    
    public function index() {
        $languages = Language::all();
        // $path = Route::current()->getName();
        // dd($path);
        return view('backend.languages.index', compact('languages'));
    }

    public function create() {
        $listLanguage = config('language.listLanguage');
        // dd($list);
        $languages = Language::all();
        foreach($languages as $lang){
            // dd($lang->code_language);
            // var_dump((($key = array_search($lang->code_language, $list))));exit;
            if(array_key_exists($lang->code_language, $listLanguage)) {
                unset($listLanguage[$lang->code_language]);
            }
            // if (($key = array_search($lang->code_language, $list)) !== false) {
            //     // var_dump($list['key']);
            //     unset($list[$key]);
            // }
        }
        // dd($list);
        return view('backend.languages.create', compact('listLanguage'));
    }

    public function store(Request $request) {
        $language = new Language();
        $selectedLanguage = $request->input('language');
        $data = explode(':', $selectedLanguage);
        $language->code_language = $data[0];
        $language->language = $data[1];
        if($language->save()) {
            // dd($language->id);
            $posts = Post::all();
            foreach ($posts as $post) {
                // dd($language->id);
                $post->languages()->attach($language->id, ['post_id' => $post->id, 'language_id' => $language->id]);
            }
            // $post->languages()->attach($language, $data);
            return redirect()->route('backend.language.index')->with('success', 'Language has been saved!');
        }

    }

    
}
