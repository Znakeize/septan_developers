<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Jobs\ShareProjectToSocial;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::latest()->paginate(12);
        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        return view('admin.projects.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'year' => 'required|string|max:50',
            'type' => 'required|string|max:255',
            'type_custom' => 'nullable|string|max:255',
            'category' => 'required|in:residential,commercial,renovation',
            'description' => 'required|string',
            'main_image' => 'required|image|max:5120',
            'gallery_images' => 'nullable|array',
            'gallery_images.*' => 'image|max:5120',
            'video_url' => 'nullable|url',
            'features' => 'nullable|array',
            'features.*.title' => 'nullable|string|max:100',
            'features.*.description' => 'nullable|string|max:500',
            'features.*.icon' => 'nullable|string|max:50',
            'client_name' => 'nullable|string|max:255',
            'project_area' => 'nullable|numeric|min:0',
            'start_date' => 'nullable|date',
            'completion_date' => 'nullable|date',
            'is_published' => 'boolean',
            'is_featured' => 'boolean',
        ]);

        // Generate slug from title
        $data['slug'] = Str::slug($data['title']);
        
        // Ensure unique slug
        $originalSlug = $data['slug'];
        $counter = 1;
        while (Project::where('slug', $data['slug'])->exists()) {
            $data['slug'] = $originalSlug . '-' . $counter;
            $counter++;
        }

        // Custom type overrides selected type if provided
        if (!empty($data['type_custom'])) {
            $data['type'] = $data['type_custom'];
        }
        unset($data['type_custom']);

        // Handle main image upload
        if ($request->hasFile('main_image')) {
            $data['main_image'] = $request->file('main_image')->store('projects', 'public');
        }

        // Handle gallery images
        $galleryImages = [];
        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $image) {
                $galleryImages[] = $image->store('projects/gallery', 'public');
            }
        }
        $data['gallery_images'] = !empty($galleryImages) ? $galleryImages : null;

        // Handle boolean fields
        $data['is_published'] = $request->has('is_published') ? true : false;
        $data['is_featured'] = $request->has('is_featured') ? true : false;

        $project = Project::create($data);

        if ($request->has('share_social')) {
            ShareProjectToSocial::dispatch($project);
        }

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project created successfully!');
    }

    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'year' => 'required|string|max:50',
            'type' => 'required|string|max:255',
            'type_custom' => 'nullable|string|max:255',
            'category' => 'required|in:residential,commercial,renovation',
            'description' => 'required|string',
            'main_image' => 'nullable|image|max:5120',
            'gallery_images' => 'nullable|array',
            'gallery_images.*' => 'image|max:5120',
            'video_url' => 'nullable|url',
            'features' => 'nullable|array',
            'features.*.title' => 'nullable|string|max:100',
            'features.*.description' => 'nullable|string|max:500',
            'features.*.icon' => 'nullable|string|max:50',
            'client_name' => 'nullable|string|max:255',
            'project_area' => 'nullable|numeric|min:0',
            'start_date' => 'nullable|date',
            'completion_date' => 'nullable|date',
            'is_published' => 'boolean',
            'is_featured' => 'boolean',
        ]);

        if (!empty($data['type_custom'])) {
            $data['type'] = $data['type_custom'];
        }
        unset($data['type_custom']);

        // Update slug if title changed
        if ($project->title !== $data['title']) {
            $data['slug'] = Str::slug($data['title']);
            $originalSlug = $data['slug'];
            $counter = 1;
            while (Project::where('slug', $data['slug'])->where('id', '!=', $project->id)->exists()) {
                $data['slug'] = $originalSlug . '-' . $counter;
                $counter++;
            }
        }

        // Handle main image upload
        if ($request->hasFile('main_image')) {
            // Delete old image
            if ($project->main_image) {
                Storage::disk('public')->delete($project->main_image);
            }
            $data['main_image'] = $request->file('main_image')->store('projects', 'public');
        } else {
            unset($data['main_image']);
        }

        // Handle gallery images
        if ($request->hasFile('gallery_images')) {
            $existingImages = $project->gallery_images ?? [];
            $newImages = [];
            foreach ($request->file('gallery_images') as $image) {
                $newImages[] = $image->store('projects/gallery', 'public');
            }
            $data['gallery_images'] = array_merge($existingImages, $newImages);
        }

        // Handle boolean fields
        $data['is_published'] = $request->has('is_published') ? true : false;
        $data['is_featured'] = $request->has('is_featured') ? true : false;

        $project->update($data);

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project updated successfully!');
    }

    public function destroy(Project $project)
    {
        // Delete main image
        if ($project->main_image) {
            Storage::disk('public')->delete($project->main_image);
        }

        // Delete gallery images
        if ($project->gallery_images) {
            foreach ($project->gallery_images as $image) {
                Storage::disk('public')->delete($image);
            }
        }

        $project->delete();

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project deleted successfully!');
    }

    public function removeGalleryImage(Request $request, Project $project, $index)
    {
        $galleryImages = $project->gallery_images ?? [];
        
        if (isset($galleryImages[$index])) {
            // Delete the image file
            Storage::disk('public')->delete($galleryImages[$index]);
            
            // Remove from array
            unset($galleryImages[$index]);
            $galleryImages = array_values($galleryImages); // Reindex array
            
            $project->update(['gallery_images' => $galleryImages]);
        }

        return response()->json(['success' => true]);
    }
}
