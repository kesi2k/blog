<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class BlogController extends Controller
{
	// Get ten posts
	public function getIndex(){
		$posts = Post::paginate(10);

		return view('blog.index')->withPosts($posts);
	}

    // Get a single post
    public function getSingle($slug){
    	// Get the post from DB based on the slug
    	$post = Post::where('slug', '=', $slug)->first();

    	// Return the found post with view
    	return view('blog.single')->with('post', $post);
    }
}
