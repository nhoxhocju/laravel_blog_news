<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $table = 'category';
    public $timestamps = false;
    protected $fillable = [
        'id',
    ];

    public function posts() {
        return $this->hasMany('App\Post', 'category_id');
    }
    public function languages() {
        return $this->belongsToMany('App\Language','language_category', 'category_id', 'language_id')->withPivot('name', 'language_id', 'category_id');
    }

}
