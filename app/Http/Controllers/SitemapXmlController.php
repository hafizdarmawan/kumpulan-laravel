<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class SitemapXmlController extends Controller
{
    public function index()
    {
        $posts = Blog::all();
        return response()->view('sitemap.index', compact('posts'))->header('Content-Type', 'text/xml');
    }
}
