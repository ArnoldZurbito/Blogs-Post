<?php 
namespace App\Http\Controllers;

use App\Post;

class PagesController extends Controller{

public function getIndex()
{
	$posts=Post::orderBy('created_at','desc')->limit(4)->get();
	return view('pages.welcome')->withPosts($posts);
}

public function getAbout()
{
	$first ="Alex";
	$last ="Zurbito";
	
	$fullname =$first ." ". $last;
	$email = 'zurbitoarnold@gmail.com';
		
$data =[];
$data['email'] = $email;
$data['fullname'] = $fullname;
return view('pages.about')->withData($data);
	// return view('pages.about')->withFullname($fullname)->withEmail($email);
}

public function getContact()
{
	return view('pages.contact');
}

}

 ?>
