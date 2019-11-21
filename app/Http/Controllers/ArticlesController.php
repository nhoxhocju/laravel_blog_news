<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\ArticleTranslation;
use App;
use DB;
use Dimsav\Translatable\Translatable;


class ArticlesController extends Controller
{

    // public function __construct(array $attributes = []) {
    //     // parent::__construct($attributes);
    
    //     $this->defaultLocale = 'vi';
    // }

    public function index($locale) {

        // app()->setLocale($locale);
        
        // $article = Article::all();
        // $article = Article::withTranslation()->get();
        // dd(App::getLocale());
        $article = Article::withTranslation()->get();
        // $article->translate($locale)->name;
        // printf($article);

        // $article = new Article;
        // $article->translations();
        // $translation = $article;
        
        // printf($translation);exit;
        // foreach ($translation as $key) {
        //     echo $key;
        // }
        // exit;
        // $article = new Article;
        // $article->articleTranslations()->where('locale', 'vi')->first();
        printf($article);exit;
        

     
        return view('article')->with(compact('article'));
    }
}
