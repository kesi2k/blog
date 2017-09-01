<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // This tells laravel to use the categories table with this model
    protected $table = 'categories';

    public function posts()
    {
    	//Connect to the post model and get the column with category_id from the posts table
    	return $this->hasMany('App\Post');
    }
}
