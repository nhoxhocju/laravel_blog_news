<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    // const VI = 'vi';
    // const EN = 'en';

    protected $table = 'language';

    public $timestamps = false;
    protected $fillable = [
        'code_langue',
        'language'
    ];

    public function posts() {
        return $this->belongsToMany('App\Post')->withPivot('title', 'content', 'image', 'language_id', 'post_id');
    }

    public function categories() {
        return $this->belongsToMany('App\Categories','language_category','language_id', 'category_id')->withPivot('name', 'language_id', 'category_id');
    }
}
