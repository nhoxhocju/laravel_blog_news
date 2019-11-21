<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostLanguage extends Model
{
    public $timestamps = false;
    protected $table = 'language_post';

    protected $fillable = [
        'title',
        'content'
    ];
    
    public function post() {
        return $this->belongsTo('App\Post');
    }

    public function language() {
        return $this->belongsTo('App\Language');
    }
}
