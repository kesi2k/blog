<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Post;
use Session;

class CommentsController extends Controller
{
    //Set authentication so unauthorized users cant use stuff in this controller
    public function __construct()
    {
        $this->middleware('auth', ['except' => 'store']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
    public function store(Request $request, $post_id)
    {
        //
        $post = Post::find($post_id);


        $this->validate($request, array(
            'name' => 'required|max:255',
            //'email' => 'required|email|max:255',
            'comment'=> 'required|min:5|max:2000'
            ));

        $comment = new Comment();
        $comment->name = $request->name;
        $comment->email = $request->email;
        $comment->comment = $request->comment;
        $comment->post()->associate($post);

        $comment->save();

        Session::flash('success', 'Comment added');

        return redirect()->route('blog.single', [$post->slug]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $comment = Comment::find($id);

         //Need to return a post variable because of select2 script expecting it. Even though the post variable is never used.
        $post = Post::find(1);

        return view('comments.edit')->withComment($comment)->withPost($post);
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
        // Get the comment and update it with the changes
        $comment = Comment::find($id);

        $this->validate($request, array('comment' => 'required'));

        $comment->comment = $request->comment;
        $comment->save();

        Session::flash('success', 'Comment updated');

        return redirect()->route('posts.show', $comment->post->id);
    }

    public function delete($id){
        $comment = Comment::find($id);

        //Need to return a post variable because of select2 script expecting it. Even though the post variable is never used.
        $post = Post::find(1);

        return view('comments.delete')->withComment($comment)->withPost($post);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Get the comment and destroy it
        $comment = Comment::find($id);
        $post_id = $comment->post->id;

        $comment->delete();

        return redirect()->route('posts.show', $post_id);
    }
}
