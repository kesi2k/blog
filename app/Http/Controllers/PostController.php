<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
use Session;
use App\Tag;
use Image;
use Storage;

class PostController extends Controller
{
    /**
    Setup for only allowing logged in users the features of this controller.
    **/
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     * We would use this section to retrieve all the posts from the DB.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // create a variable to store all variables
        //$posts = Post::all();
        //paginate command in eloquent

        //Using ids to sort is faster because it is an indexed column and dates are not
        $posts = Post::orderBy('id', 'desc')->paginate(5);


        //pass in the variable to a view
        return view('posts.index')->withPosts($posts);
    }

    /**
     * Show the form for creating a new resource.
     *  
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //If there is an error in the store function an error message is returned in
        // the flash function.

        // Get all the categories and pass them to the create page.
        $categories = Category::all();

        $tags = Tag::all();

        //Need to return a post variable because of select2 script expecting it. Even though the post variable is never used.
        $post = Post::find(1);


        return view('posts.create')->withCategories($categories)->with('tags', $tags)->withPost($post);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate the data
        // If information does not make it past validation, the posts.create page is returned.
        // Validates in order listed e.g. required, alpha_dash format, min submission length and
        // finally max submission length 


        //dd($request);

        $this->validate($request, array(
            'title'         => 'required|max:255',
            'slug'          => 'required|alpha_dash|min:5|max:255|unique:posts,slug',
            'category_id'   => 'required|integer',
            'body'          => 'required',
            'featured_image' => 'sometimes|image'

            ));
        // store in the DB
        $post = new Post;

        $post->title = $request->title;
        $post->slug = $request->slug;
        $post->category_id = $request->category_id;
        $post->body = $request->body;


        //Saving image if there is one
        if($request->hasFile('featured_image')){
            $image = $request->file('featured_image');
            //Needs to save as a unique name in order to avoid conflict
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('images/' . $filename);
            Image::make($image)->resize(800, 400)->save($location);

            // Save the location of the file to the DB
            $post->image = $filename;
        }

        $post->save();

        // Tags need to be saved after posts initial save. It is in a different table
        // If false is left out of this parameter, it assumes true and overrides existing associations.
        $post->tags()->sync($request->tags, false);

        // Flash saved in session for a single request
        // First value is the variable we use to call it
        // Command for use during an entire session is:
        // Session::put
        Session::flash('success', 'Post saved successfully.');


        //redirect to page
        return redirect()->route('posts.show', $post->id);
    }

    /**
     * Display the specified resource./specified blog post
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $post = Post::find($id);
        return view('posts.show')->with('post', $post);
        //OR
        //return view('posts.show')->withPost($post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // find the post and save as a variable
        $post = Post::find($id);

        // Get all the categories and pass them to the create page.
        $categories = Category::all();
        $categoriesArr = array();

        foreach($categories as $category){
            $categoriesArr[$category->id] = $category->name;
        }

        $tags = Tag::all();
        $tagsArr = array();

        foreach($tags as $tag){
            $tagsArr[$tag->id] = $tag->name;
        }

        //Creating array to put in form

        // Return the view with the variable we created
        return view('posts.edit')->withPost($post)->withCategories($categoriesArr)->withTags($tagsArr);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validate the data
        // validate the data
        // If information does not make it past validation, the posts.create page is returned.
        // Check to see if slug has changed, validate and save. If not just save
        $post = Post::find($id);

        if ($request->input('slug') == $post->slug)
        {
            $this->validate($request, array(
            'title' => 'required|max:255',
            'body'  => 'required',
            'category_id'   => 'required|integer',
            ));
        }else{
            $this->validate($request, array(
            'title' => 'required|max:255',
            'slug'  => 'required|alpha_dash|min:5|max:255|unique:posts,slug',
            'body'  => 'required',
            'category_id'   => 'required|integer',
            'featured_image' => 'image'
            ));
        }

        //Save the data to the DB
        $post = Post::find($id);


        //Input grabs parameters from the GET request or PUT request 
        $post->title = $request->input('title');
        $post->slug = $request->input('slug');
        $post->body = $request->input('body');
        $post->category_id = $request->category_id;

        if($request->hasFile('featured_image')){
            //Add new photo, update the DB and delete the old photo
            // Settings for file saving edited in config/filesystems.php
            $image = $request->file('featured_image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('images/' . $filename);
            Image::make($image)->resize(800, 400)->save($location);

            $oldFilename = $post->image;

            $post->image = $filename;

            Storage::delete($oldFilename);
        }

        $post->save();

        // Tags need to be saved after posts initial save. It is in a different table
        // True used here because we would like to save all the new relationships.
        if(isset($request->tags)){
            $post->tags()->sync($request->tags, true);
        }
        else{
            $posts->tags()->sync(array());
        }

        // Set flash data with success message
        Session::flash('success', 'This post was successfully edited.');


        //Redirect with flash data to posts.show
        return redirect()->route('posts.show', $post->id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //find post and set it to variable
        $post = Post::find($id);

        //With the many to many relationship setup we can use the detach command
        $post->tags()->detach();
        Storage::delete($post->image);

        $post->delete();

        Session::flash('success', 'The post was deleted');

        return redirect()->route('posts.index');
    }
}
