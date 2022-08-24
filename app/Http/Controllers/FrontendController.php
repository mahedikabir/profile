<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class FrontendController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function index()
    {
        return view('frontend.index');
    }

    public function experiences(){
        return view('frontend.experiences');
    }

    public function research(){
        return view('frontend.research');
    }

    public function blog(){
        $posts = Post::where('published', 'yes')->paginate('9');
        return view ('frontend.blog', compact('posts'));
    }

    public function blogView($slug){
        $post = Post::where('slug', $slug)->first();
        return view ('frontend.blogView', compact('post'));
    }
}
