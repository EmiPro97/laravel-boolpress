<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable =
    [
        'category_id',
        'title',
        'slug',
        'content',
        'cover',
    ];


    // Relations with categories
    public function category()
    {
        return $this->belongsTo('App\Category');
    }


    // Relations with tags
    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }
}
