<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ProjectController as PublicProjectController;
use App\Http\Controllers\BlogController as PublicBlogController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProjectController as AdminProjectController;
use App\Http\Controllers\Admin\BlogController as AdminBlogController;
use App\Http\Controllers\Admin\SocialController as AdminSocialController;
use App\Http\Controllers\Admin\SocialMediaController as AdminSocialMediaController;
use App\Http\Controllers\Admin\SettingsController;

Route::get('/', function () {
     // Prefer published projects; if none, fallback to latest regardless of publish state.
     $projectsQuery = \App\Models\Project::query()
         ->orderByDesc('is_featured')
         ->latest();

     $projects = (clone $projectsQuery)
         ->where('is_published', true)
         ->limit(6)
         ->get();

     if ($projects->isEmpty()) {
         $projects = $projectsQuery
             ->limit(6)
             ->get();
     }
     $latestBlogs = \App\Models\Blog::where('is_published', true)->latest('published_date')->limit(6)->get();
     
     // Get hero images from database
     $heroImageRecord = DB::table('hero_images')->where('page_type', 'home')->first();
     $heroImages = [];
     if ($heroImageRecord && $heroImageRecord->images) {
         $heroImages = json_decode($heroImageRecord->images, true);
         // Convert to full URLs
         $heroImages = array_map(function($image) {
             return asset('storage/' . $image);
         }, $heroImages);
     }
     
     // Fallback to default images if none in database
     if (empty($heroImages)) {
         $heroImages = [
             asset('assets/img/amila_ruwan-liyanapathirana-wood-locally-bricks-hotel-moksha-nature-sri-lanka-designboom-03-1-b5a51208.jpg'),
             asset('assets/img/seamless-regeneration-in-the-jungle-5-633956dc14e9a-5316f9fa.jpg'),
             asset('assets/img/palinda-kannagara-linear-house-at-battaramulla-sri-lanka-designboom-mobile-55e43d88.jpg'),
             asset('assets/img/sri-lanka-60e70f72.jpg'),
             asset('assets/img/Eco-Friendly-House-Designs-in-Sri-Lanka-4-d631f37c.jpg'),
         ];
     }
     
     return view('Home', compact('projects', 'latestBlogs', 'heroImages'));
 })->name('home');

// Helper function to get hero images for a page
$getHeroImages = function($pageType) {
    $heroImageRecord = DB::table('hero_images')->where('page_type', $pageType)->first();
    if ($heroImageRecord && $heroImageRecord->images) {
        $images = json_decode($heroImageRecord->images, true);
        return array_map(function($image) {
            return asset('storage/' . $image);
        }, $images);
    }
    return [];
};

Route::get('/3d-rendering', function () use ($getHeroImages) {
     $heroImages = $getHeroImages('3d-rendering');
     return view('Service_3d_rendering', compact('heroImages'));
 })->name('services.3d_rendering');
Route::get('/services/architectural-design', function () use ($getHeroImages) {
     $heroImages = $getHeroImages('architectural-design');
     return view('Service_architectural_design', compact('heroImages'));
 })->name('services.architectural_design');
Route::get('/services/bim', function () use ($getHeroImages) {
     $heroImages = $getHeroImages('bim-page');
     return view('Service_bim', compact('heroImages'));
 })->name('services.bim');
Route::get('/services/estimation', function () use ($getHeroImages) {
     $heroImages = $getHeroImages('estimation-page');
     return view('Service_estimation', compact('heroImages'));
 })->name('services.estimation');
Route::get('/services/interior-design', function () use ($getHeroImages) {
     $heroImages = $getHeroImages('interior-design');
     return view('Service_interior_design', compact('heroImages'));
 })->name('services.interior_design');
Route::get('/services/project-management', function () use ($getHeroImages) {
     $heroImages = $getHeroImages('project-management');
     return view('Service_project_management', compact('heroImages'));
 })->name('services.project_management');
Route::get('/services/structural-design', function () use ($getHeroImages) {
     $heroImages = $getHeroImages('structural-design');
     return view('Service_structural_design', compact('heroImages'));
 })->name('services.structural_design');

// Legal pages
Route::get('/terms', function () {
     return view('terms');
})->name('legal.terms');
Route::get('/privacy', function () {
     return view('privacy');
})->name('legal.privacy');

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
     Route::get('social', [AdminSocialMediaController::class, 'index'])->name('social.index');
     Route::post('social', [AdminSocialController::class, 'store'])->name('social.store');
     Route::post('social/account', [AdminSocialMediaController::class, 'storeAccount'])->name('social.account.store');
     Route::post('social/preview', [AdminSocialMediaController::class, 'previewPost'])->name('social.preview');
     Route::post('social/publish-now', [AdminSocialMediaController::class, 'publishNow'])->name('social.publish-now');
     Route::post('social/schedule', [AdminSocialMediaController::class, 'schedulePost'])->name('social.schedule');
     Route::get('social/connect/{platform}', [AdminSocialMediaController::class, 'connectAccount'])->name('social.connect');
     Route::get('social/callback/{platform}', [AdminSocialMediaController::class, 'handleCallback'])->name('social.callback');
     Route::delete('social/disconnect/{account}', [AdminSocialMediaController::class, 'disconnectAccount'])->name('social.disconnect');
     Route::get('social/export-links', [AdminSocialMediaController::class, 'exportLinks'])->name('social.export-links');
     Route::get('settings', [SettingsController::class, 'index'])->name('settings.index');
     Route::post('settings/hero-images', [SettingsController::class, 'updateHeroImages'])->name('settings.hero-images.update');
     Route::delete('settings/hero-images/{pageType}/{index}', [SettingsController::class, 'removeHeroImage'])->name('settings.hero-images.remove');
});

// Auth routes
require __DIR__.'/auth.php';