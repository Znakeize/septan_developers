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

        $maxPerSection = 10;
        foreach ($pageTypes as $pageType => $fieldName) {
            // Get existing record and images
            $existing = DB::table('hero_images')->where('page_type', $pageType)->first();
            $existingImages = [];
            if ($existing && $existing->images) {
                $existingImages = array_values(array_filter((array) json_decode($existing->images, true)));
            }

            if ($request->hasFile($fieldName)) {
                $newFiles = $request->file($fieldName);

                // Enforce overall cap (existing + new <= $maxPerSection)
                $availableSlots = max(0, $maxPerSection - count($existingImages));
                if (count($newFiles) > $availableSlots) {
                    return back()
                        ->withErrors([ $fieldName => "You can upload up to {$maxPerSection} images for this section. Remove some images first." ])
                        ->withInput();
                }

                // Store new files
                $stored = [];
                foreach ($newFiles as $file) {
                    $stored[] = $file->store('hero_images', 'public');
                }

                $merged = array_values(array_merge($existingImages, $stored));

                if ($existing) {
                    DB::table('hero_images')->where('page_type', $pageType)->update([
                        'images' => json_encode($merged),
                        'updated_at' => now(),
                    ]);
                } else {
                    DB::table('hero_images')->insert([
                        'page_type' => $pageType,
                        'images' => json_encode($merged),
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