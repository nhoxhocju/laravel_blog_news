<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Dimsav\Translatable\Translatable;
use Eloquent;

class Article extends Model 
{
    use Translatable;

    public $translatedAttributes = ['name', 'text'];
    public $translationModel = 'App\ArticleTranslation';

    public function articleTranslations() {
        return $this->hasMany('App\ArticleTranslation');
    }


    
}

// app()->setLocale('vi');
// $vietnameseText = $article->text;
