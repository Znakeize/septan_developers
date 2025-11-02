<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController as PublicProjectController;
use App\Http\Controllers\BlogController as PublicBlogController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProjectController as AdminProjectController;
use App\Http\Controllers\Admin\BlogController as AdminBlogController;

Route::get('/', function () {
     $projects = \App\Models\Project::where('is_published', true)->latest()->limit(6)->get();
     $latestBlogs = \App\Models\Blog::where('is_published', true)->latest('published_date')->limit(3)->get();
     return view('Home', compact('projects', 'latestBlogs'));
 })->name('home');

Route::get('/3d-rendering', function () {
     return view('Service_3d_rendering');
 })->name('services.3d_rendering');
Route::get('/services/architectural-design', function () {
     return view('Service_architectural_design');
 })->name('services.architectural_design');
Route::get('/services/bim', function () {
     return view('Service_bim');
 })->name('services.bim');
Route::get('/services/estimation', function () {
     return view('Service_estimation');
 })->name('services.estimation');
Route::get('/services/interior-design', function () {
     return view('Service_interior_design');
 })->name('services.interior_design');
Route::get('/services/project-management', function () {
     return view('Service_project_management');
 })->name('services.project_management');
Route::get('/services/structural-design', function () {
     return view('Service_structural_design');
 })->name('services.structural_design');

// Public Projects
Route::prefix('projects')->name('projects.')->group(function () {
     Route::get('/', [PublicProjectController::class, 'index'])->name('index');
     Route::get('/{project:slug}', [PublicProjectController::class, 'show'])->name('show');
});

// Public Blogs
Route::prefix('blogs')->name('blogs.')->group(function () {
     Route::get('/', [PublicBlogController::class, 'index'])->name('index');
     Route::get('/{blog:slug}', [PublicBlogController::class, 'show'])->name('show');
});

// Admin
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
     Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
     Route::resource('projects', AdminProjectController::class);
     Route::delete('projects/{project}/gallery/{index}', [AdminProjectController::class, 'removeGalleryImage'])->name('projects.gallery.remove');
     Route::resource('blogs', AdminBlogController::class);
});

// Auth routes
require __DIR__.'/auth.php';