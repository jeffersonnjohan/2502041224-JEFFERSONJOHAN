<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(){
        $all = Post::all();
        // Sort berdasarkan ratingcount tertinggi ke rendah, lalu diambil 1 (paling tinggi)
        $highlightPost = Post::orderBy('ratingcount', 'desc')->take(1)->get()[0];
        // latest() untuk mendapatkan post dengan created_at terbaru
        $latestPosts = Post::latest()->take(4)->get();

        return view('home', [
            'allPosts' => $all,
            'highlightPost' => $highlightPost,
            'latestPosts' => $latestPosts
        ]);
    }

    public function show($id){
        $post = Post::find($id);

        return view('detail', [
            'post' => $post
        ]);
    }
}
