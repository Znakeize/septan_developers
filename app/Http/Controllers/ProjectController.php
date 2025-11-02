<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::where('is_published', true)
            ->latest()
            ->paginate(12);
        return view('projects.index', compact('projects'));
    }

    public function show(Project $project)
    {
        // Only show published projects
        if (!$project->is_published) {
            abort(404);
        }

        // Get related projects (same category, excluding current)
        $relatedProjects = Project::where('is_published', true)
            ->where('category', $project->category)
            ->where('id', '!=', $project->id)
            ->latest()
            ->limit(3)
            ->get();

        return view('projects.show', compact('project', 'relatedProjects'));
    }
}
