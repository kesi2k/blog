<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	public function category()
	{
    // A post belongs to a category identified by the category_id column in the post table
    return $this->belongsTo('App\Category');
	}

	// Many to many relationship with the tags
	public function tags()
	{
		return $this->belongsToMany('App\Tag');

	}
	//A post has many comments
	public function comments()
	{
		return $this->hasMany('App\Comment');
	}

}
