<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\PostLanguage;
use Illuminate\Support\Facades\Facade;

class Post extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'id',
        'thumbnail',
        'slug',
    ];
    
    public function languages() {
        return $this->belongsToMany('App\Language')->withPivot('title', 'content', 'image', 'language_id', 'post_id');
    }

    public function categories() {
        return $this->belongsTo('App\Categories');
    }

    // public function delete($id) {
    //     Schema::create('posts', function (Blueprint $table) {
    //         // Some other fields...
        
    //         $table->integer('id')->unsigned();
    //         $table->foreign('post_id')->references('id')->on('language_post')->onDelete('cascade');
    //     });
    // }
}
