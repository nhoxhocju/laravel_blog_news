<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticleTranslation extends Model
{
    protected $fillable = ['name', 'text'];
    public $timestamps = false;

}
