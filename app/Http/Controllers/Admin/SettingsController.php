<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class SettingsController extends Controller
{
    public function index()
    {
        $heroImages = DB::table('hero_images')->get()->keyBy('page_type');
        return view('admin.settings.index', compact('heroImages'));
    }

    public function updateHeroImages(Request $request)
    {
        $validated = $request->validate([
            'home_images' => 'nullable|array',
            'home_images.*' => 'image|max:5120',
            'architectural_design_images' => 'nullable|array',
            'architectural_design_images.*' => 'image|max:5120',
            'structural_design_images' => 'nullable|array',
            'structural_design_images.*' => 'image|max:5120',
            'bim_images' => 'nullable|array',
            'bim_images.*' => 'image|max:5120',
            'interior_design_images' => 'nullable|array',
            'interior_design_images.*' => 'image|max:5120',
            '3d_rendering_images' => 'nullable|array',
            '3d_rendering_images.*' => 'image|max:5120',
            'estimation_images' => 'nullable|array',
            'estimation_images.*' => 'image|max:5120',
            'project_management_images' => 'nullable|array',
            'project_management_images.*' => 'image|max:5120',
        ]);

        $pageTypes = [
            'home' => 'home_images',
            'architectural-design' => 'architectural_design_images',
            'structural-design' => 'structural_design_images',
            'bim-page' => 'bim_images',
            'interior-design' => 'interior_design_images',
            '3d-rendering' => '3d_rendering_images',
            'estimation-page' => 'estimation_images',
            'project-management' => 'project_management_images',
        ];

        foreach ($pageTypes as $pageType => $fieldName) {
            if ($request->hasFile($fieldName)) {
                $images = [];
                foreach ($request->file($fieldName) as $file) {
                    $path = $file->store('hero_images', 'public');
                    $images[] = $path;
                }
                
                $existing = DB::table('hero_images')->where('page_type', $pageType)->first();
                if ($existing) {
                    // Delete old images
                    if ($existing->images) {
                        $oldImages = json_decode($existing->images, true);
                        foreach ($oldImages as $oldImage) {
                            Storage::disk('public')->delete($oldImage);
                        }
                    }
                    // Update existing
                    DB::table('hero_images')->where('page_type', $pageType)->update([
                        'images' => json_encode($images),
                        'updated_at' => now(),
                    ]);
                } else {
                    // Create new
                    DB::table('hero_images')->insert([
                        'page_type' => $pageType,
                        'images' => json_encode($images),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }

        return redirect()->route('admin.settings.index')->with('success', 'Hero images updated successfully!');
    }

    public function removeHeroImage(Request $request, $pageType, $index)
    {
        $heroImage = DB::table('hero_images')->where('page_type', $pageType)->first();
        if ($heroImage && $heroImage->images) {
            $images = json_decode($heroImage->images, true);
            if (isset($images[$index])) {
                Storage::disk('public')->delete($images[$index]);
                unset($images[$index]);
                $images = array_values($images);
                
                DB::table('hero_images')->where('page_type', $pageType)->update([
                    'images' => json_encode($images),
                    'updated_at' => now(),
                ]);
            }
        }
        return response()->json(['success' => true]);
    }
}