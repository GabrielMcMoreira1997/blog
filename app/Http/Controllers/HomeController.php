<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $posts = \App\Models\Post::with(['author', 'categories', 'content'])
            ->orderBy('published_at', 'desc')
            ->paginate(10);

        return view('public.index', compact('posts'));
    }

    public function policy()
    {
        return view('public.policy');
    }
}
