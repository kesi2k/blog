<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Session;

//use App\Http\Requests;

use App\Post;
use Mail;

class pagesController extends Controller{
    public function getIndex(){


    }

    public function getAbout(){
        $firstName='Makesi';
        $lastName='Hamilton';
        $name=$firstName." ".$lastName;
        $email="mhamilton868@gmail.com";
        $data=[];
        $data["email"]=$email;
        $data["name"]=$name;
        //name variable in view is "name"
        //return view('about')->with("name", $name)->with("email", $email);
        //passing all the info in as an array
        return view('about')->with("data", $data);
    }

    public function getContact(){

        $post = Post::find(1);

        return view('contact')->withPost($post);
    }

    public function getFrontPage(){
        #process variables submitted in form
        #talk to model
        #Model hits up DB
        #Get information from updated model and process it
        #Go to the view
        //Get posts and store in variable
        $posts = Post::orderBy('id','desc')->get();
        return view('frontpage')->with('posts', $posts);
    }

    public function postContact(Request $request){
        $this->validate($request, ['email' => 'required|email',
                                   'subject' => 'min:3',
                                   'message' => 'min:10'
                                    ]);
        //email info is in the request. We need to set it up as an array and then pass it to the view. message is an already named variable
        $data = array('email' => $request->email,
                       'subject' => $request->subject,
                       'bodyMessage' => $request->message
                       );
        Mail::send('emails.contact', $data, function($message) use ($data){
            $message->from($data['email']);
            $message->to('mhamilton@senegalsoftware.com');
            $message->subject($data['subject']);

        });
        Session::flash('success', 'Email sent');

        return redirect('/frontpage');

    }
}