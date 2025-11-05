<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Jobs\ShareBlogToSocial;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::with('user')->latest()->paginate(15);
        return view('admin.blogs.index', compact('blogs'));
    }

    public function create()
    {
        return view('admin.blogs.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'excerpt' => 'required|string|max:500',
            'content' => 'required|string',
            'featured_image' => 'required|image|max:5120',
            'tags' => 'nullable|string',
            'published_date' => 'required|date',
            'is_published' => 'boolean',
        ]);

        // Generate slug from title
        $data['slug'] = Str::slug($data['title']);
        
        // Ensure unique slug
        $originalSlug = $data['slug'];
        $counter = 1;
        while (Blog::where('slug', $data['slug'])->exists()) {
            $data['slug'] = $originalSlug . '-' . $counter;
            $counter++;
        }

        // Handle featured image upload
        if ($request->hasFile('featured_image')) {
            $data['featured_image'] = $request->file('featured_image')->store('blogs', 'public');
        }

        // Handle tags (convert comma-separated string to array)
        if (!empty($data['tags'])) {
            $tags = array_map('trim', explode(',', $data['tags']));
            $data['tags'] = array_filter($tags); // Remove empty tags
        } else {
            $data['tags'] = null;
        }

        // Set user_id
        $data['user_id'] = auth()->id();

        // Handle boolean field
        $data['is_published'] = $request->has('is_published') ? true : false;

        $blog = Blog::create($data);

        if ($request->has('share_social')) {
            ShareBlogToSocial::dispatch($blog);
        }

        return redirect()->route('admin.blogs.index')
            ->with('success', 'Blog article created successfully!');
    }

    public function edit(Blog $blog)
    {
        return view('admin.blogs.edit', compact('blog'));
    }

    public function update(Request $request, Blog $blog)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'excerpt' => 'required|string|max:500',
            'content' => 'required|string',
            'featured_image' => 'nullable|image|max:5120',
            'tags' => 'nullable|string',
            'published_date' => 'required|date',
            'is_published' => 'boolean',
        ]);

        // Update slug if title changed
        if ($blog->title !== $data['title']) {
            $data['slug'] = Str::slug($data['title']);
            $originalSlug = $data['slug'];
            $counter = 1;
            while (Blog::where('slug', $data['slug'])->where('id', '!=', $blog->id)->exists()) {
                $data['slug'] = $originalSlug . '-' . $counter;
                $counter++;
            }
        }

        // Handle featured image upload
        if ($request->hasFile('featured_image')) {
            // Delete old image
            if ($blog->featured_image) {
                Storage::disk('public')->delete($blog->featured_image);
            }
            $data['featured_image'] = $request->file('featured_image')->store('blogs', 'public');
        } else {
            unset($data['featured_image']);
        }

        // Handle tags (convert comma-separated string to array)
        if (!empty($data['tags'])) {
            $tags = array_map('trim', explode(',', $data['tags']));
            $data['tags'] = array_filter($tags); // Remove empty tags
        } else {
            $data['tags'] = null;
        }

        // Handle boolean field
        $data['is_published'] = $request->has('is_published') ? true : false;

        $blog->update($data);

        return redirect()->route('admin.blogs.index')
            ->with('success', 'Blog article updated successfully!');
    }

    public function destroy(Blog $blog)
    {
        // Delete featured image
        if ($blog->featured_image) {
            Storage::disk('public')->delete($blog->featured_image);
        }

        $blog->delete();

        return redirect()->route('admin.blogs.index')
            ->with('success', 'Blog article deleted successfully!');
    }
}
