<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function tags()
    {
        return $this->belongsToMany('App\Tag', 'tag_post');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
