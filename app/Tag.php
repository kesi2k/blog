<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //
    public function posts()
    {
    	// after the model youre linking to the required fields are ('App\Post', 'name_of_table', 'tag_id', 'post_id')
    	// It looks for those columns in the intermediary table. The intermediary table name is built 
    	// in alphabetical order from the two table names.
    	return $this->belongsToMany('App\Post', 'post_tag');
    }
}
