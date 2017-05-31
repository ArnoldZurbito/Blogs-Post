<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;  
use App\Http\Requests;
use App\Post;

class BlogController extends Controller
{
	public function getIndex(){
		$posts=Post::paginate(5);
		return view('blog.index')->withPosts($posts);
	}
    //
	public function getSingle($slug){
		// return $slug;
		//fetch from the DB
		$post=Post::where('slug','=', $slug)->first();
		//return the view and pass in the object
		return view('blog.single')->withPost($post);
		
	}
}