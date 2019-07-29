<?php

namespace App\Http\Controllers;
use
    App\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index()
    {
    	return view('index');
    }

    public function blog()
    {
        $posts = Post::published()->get();
    	return view('welcome',compact('posts'));
    }
}
