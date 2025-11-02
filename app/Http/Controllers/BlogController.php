<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::where('is_published', true)
            ->with('user')
            ->latest('published_date')
            ->paginate(12);
        return view('blogs.index', compact('blogs'));
    }

    public function show(Blog $blog)
    {
        // Only show published blogs
        if (!$blog->is_published) {
            abort(404);
        }

        // Increment views
        $blog->incrementViews();

        // Get related blogs (same category, excluding current)
        $relatedBlogs = Blog::where('is_published', true)
            ->where('category', $blog->category)
            ->where('id', '!=', $blog->id)
            ->latest('published_date')
            ->limit(3)
            ->get();

        return view('blogs.show', compact('blog', 'relatedBlogs'));
    }
}
