<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;
use App\Post;

use Session;


class TagController extends Controller
{
    // Only allows authenticated users access
    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get all the tags
        $tags = Tag::all();

        //Need to return a post variable because of select2 script expecting it. Even though the post variable is never used.
        $post = Post::find(1);

        return view('tags.index')->withTags($tags)->withPost($post);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // no creation, just selection
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, array('name' => 'required|max:255'));
        $tag = new Tag;
        $tag->name = $request->name;

        //save tag
        $tag->save();

        Session::flash('success', 'New Tag was saved');

        return redirect()->route('tags.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //Get the tag and send them to the view
        $tag = Tag::find($id);
        //Need to return a post variable because of select2 script expecting it. Even though the post variable is never used.
        $post = Post::find(1);

        return view('tags.show')->withTag($tag)->withPost($post);

        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //Find the tag to edit and return it to the view
        $tag = Tag::find($id);
        //Need to return a post variable because of select2 script expecting it. Even though the post variable is never used.
        $post = Post::find(1);

        return view('tags.edit')->withTag($tag)->withPost($post);
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
        //Get the tag and update it
        $tag = Tag::find($id);

        $this->validate = $request->name;
        $tag->name = $request->name;
        
        $tag->save();

        Session::flash('success', 'Successfully saved');

        return redirect()->route('tags.show', $tag->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Find the tag and remove it from posts models then delete
        $tag = Tag::find($id);

        $tag->posts()->detach();

        $tag->delete();

        Session::flash('success', 'Tag deleted');

        return redirect()->route('tags.index');
    }
}
