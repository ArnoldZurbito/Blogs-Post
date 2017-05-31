<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Http\Controllers\Controller;
use App\Post;
use Session;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$posts=Post::all();
         //display above code of all database laman
        
        //create a variable and store it to database

        $posts=Post::orderBy('id','desc')->paginate(10);
        //return a view and pass in the above variable
        return view('posts.index')->withPosts($posts);   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
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
        $this->validate($request,array(
        'title'=> 'required|max:255',
        'slug'=> 'required|alpha_dash|min:5|max:255|unique:posts,slug',
        'body'=> 'required'
    ));

    //store database
    $post =new Post;
    $post->title=$request->title;
    $post->slug=$request->slug;
    $post->body=$request->body;

    $post->save();

    Session::flash('success','The Blog Post was Successfully Saved!');


//redirect to another page
        return redirect()->route('posts.show',$post->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //pass to parameter
        $post = Post::find($id);
        //go to show in post folder
        return view('posts.show')->withPost($post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // find the post n the databae and save as a variable
        $post =Post::find($id);
        //return the view and pass in the variable
         return view('posts.edit')->withPost($post);

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
    //Validate the data
        $post = Post::find($id);
        if($request->input('slug') == $post->slug){
            //code
        $this->validate($request,array(
        'title'=> 'required|max:255',
        'body'=> 'required'
        )); 
        }else{
                $this->validate($request,array(
                    'title'=> 'required|max:255',
                    'slug'=> 'required|alpha_dash|min:5|max:255|unique:posts,slug',
                    'body'=> 'required'
                ));        
}
    //Save the data to the database
       $post = Post::find($id);

       $post->title = $request->input('title');      
       $post->slug = $request->input('slug');
       $post->body = $request->input('body'); 

       $post->save();

        //set flash message with sucess message
        Session::flash('success', 'This post was successfully saved.');
        
        //redirect with the flash data to posts.show
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
        //find 
        $post=Post::find($id);
        $post->delete();
        Session::flash('success','The post has been successfully deleted.');
        return redirect()->route('posts.index');
    }
}
