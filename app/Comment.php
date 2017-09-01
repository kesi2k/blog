<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //A comment belongs to a post
    public function post()
    {
    	return $this->belongsTo('App\Post');
    }
}
