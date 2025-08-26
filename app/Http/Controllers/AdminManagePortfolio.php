<?php

namespace App\Http\Controllers;

use App\Helpers\IndexNowHelper;
use App\Models\Achievement;
use App\Models\DesignGallery;
use App\Models\CaseStudy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;

class AdminManagePortfolio extends Controller
{
    //
    public function managePortfolio()
    {
        $user = auth()->guard('admin')->user();
        if (!in_array($user->role, ['super_admin', 'admin','god_admin'])) {
            abort(403, 'Unauthorized');
        }
        return view('admin.manage-portfolio');
    }
    public function managePortfolioGallery()
    {
        
        $designs = DesignGallery::orderBy('order')->get();
        $categories = DesignGallery::getCategories();
        return view('admin.portfolio.manage-gallery', compact('designs', 'categories'));
    }
    public function storeGallery(Request $request)
    {
        $user = auth()->guard('admin')->user();
        if (!in_array($user->role, ['super_admin', 'admin', 'god_admin'])) {
            abort(403, 'Unauthorized');
        }
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'image' => 'required|url|max:255',
                'link' => 'nullable|url|max:255',
                'category' => 'required|string|in:web_dev,app_dev,ui_ux',
                'is_featured' => 'boolean'
            ]);

            $gallery = new DesignGallery();
            $gallery->title = $request->title;
            $gallery->image = $request->image;
            $gallery->link = $request->link;
            $gallery->category = $request->category;
            $gallery->is_featured = $request->is_featured ?? false;
            $gallery->order = DesignGallery::max('order') + 1;
            $gallery->save();

            // Clear the cache after adding new design
            Cache::forget('design_gallery_featured');

            return response()->json([
                'success' => true,
                'message' => 'Design added successfully',
                'design' => $gallery
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error adding design: ' . $e->getMessage()
            ], 422);
        }
    }
    public function updateGallery(Request $request, $id)
    {
        $user = auth()->guard('admin')->user();
        if (!in_array($user->role, ['super_admin', 'admin', 'god_admin'])) {
            abort(403, 'Unauthorized');
        }
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'image' => 'required|url|max:255',
                'link' => 'nullable|url|max:255',
                'category' => 'required|string|in:web_dev,app_dev,ui_ux',
                'is_featured' => 'boolean'
            ]);

            $gallery = DesignGallery::findOrFail($id);
            $gallery->title = $request->title;
            $gallery->image = $request->image;
            $gallery->link = $request->link;
            $gallery->category = $request->category;
            $gallery->is_featured = $request->is_featured ?? false;
            $gallery->save();

            // Clear the cache after updating design
            Cache::forget('design_gallery_featured');

            return response()->json([
                'success' => true,
                'message' => 'Design updated successfully',
                'design' => $gallery
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating design: ' . $e->getMessage()
            ], 422);
        }
    }
    public function deleteGallery($id)
    {
        $user = auth()->guard('admin')->user();
        if (!in_array($user->role, ['super_admin', 'admin', 'god_admin'])) {
            abort(403, 'Unauthorized');
        }
        try {
            $gallery = DesignGallery::findOrFail($id);
            $gallery->delete();

            // Clear the cache after deleting design
            Cache::forget('design_gallery_featured');

            return response()->json([
                'success' => true,
                'message' => 'Design deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting design: ' . $e->getMessage()
            ], 422);
        }
    }
    public function manageCaseStudies()
    {
        $user = auth()->guard('admin')->user();
        if (!in_array($user->role, ['super_admin', 'god_admin'])) {
            abort(403, 'Unauthorized');
        }
        $caseStudies = CaseStudy::orderBy('order')->get();
        $categories = CaseStudy::getCategories();
        return view('admin.portfolio.manage-case-studies', compact('caseStudies', 'categories'));
    }
    public function storeCaseStudy(Request $request)
    {
        $user = auth()->guard('admin')->user();
        if (!in_array($user->role, ['super_admin', 'god_admin'])) {
            abort(403, 'Unauthorized');
        }
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'image' => 'required|url|max:255',
                'category' => 'required|string|in:web_dev,app_dev,ui_ux,branding,mobile',
                'duration' => 'required|string|max:50',
                'role' => 'required|string|max:100',
                'description' => 'required|string',
                'link' => 'nullable|url|max:255',
                'tags' => 'required|array',
                'stats' => 'required|array',
            ]);

            $caseStudy = new CaseStudy();
            $caseStudy->title = $request->title;
            $caseStudy->image = $request->image;
            $caseStudy->category = $request->category;
            $caseStudy->duration = $request->duration;
            $caseStudy->role = $request->role;
            $caseStudy->description = $request->description;
            $caseStudy->link = $request->link;
            $caseStudy->tags = $request->tags;
            $caseStudy->stats = $request->stats;
            $caseStudy->is_featured = $request->is_featured ?? false;
            $caseStudy->order = CaseStudy::max('order') + 1;
            $caseStudy->save();

            // Clear the cache
            Cache::forget('case_studies_featured');
            // ✅ Ping IndexNow
            IndexNowHelper::ping($caseStudy);
            return response()->json([
                'success' => true,
                'message' => 'Case study added successfully',
                'caseStudy' => $caseStudy
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error adding case study: ' . $e->getMessage()
            ], 422);
        }
    }
    public function updateCaseStudy(Request $request, $id)
    {
        $user = auth()->guard('admin')->user();
        if (!in_array($user->role, ['super_admin', 'god_admin'])) {
            abort(403, 'Unauthorized');
        }
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'image' => 'required|url|max:255',
                'category' => 'required|string|in:web_dev,app_dev,ui_ux,branding,mobile',
                'duration' => 'required|string|max:50',
                'role' => 'required|string|max:100',
                'description' => 'required|string',
                'link' => 'nullable|url|max:255',
                'tags' => 'required|array',
                'stats' => 'required|array',
            ]);

            $caseStudy = CaseStudy::findOrFail($id);
            $caseStudy->title = $request->title;
            $caseStudy->image = $request->image;
            $caseStudy->category = $request->category;
            $caseStudy->duration = $request->duration;
            $caseStudy->role = $request->role;
            $caseStudy->description = $request->description;
            $caseStudy->link = $request->link;
            $caseStudy->tags = $request->tags;
            $caseStudy->stats = $request->stats;
            $caseStudy->is_featured = $request->is_featured ?? false;
            $caseStudy->save();

            // Clear the cache
            Cache::forget('case_studies_featured');
            // ✅ Trigger IndexNow ping
            IndexNowHelper::ping($caseStudy);
            return response()->json([
                'success' => true,
                'message' => 'Case study updated successfully',
                'caseStudy' => $caseStudy
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating case study: ' . $e->getMessage()
            ], 422);
        }
    }
    public function deleteCaseStudy($id)
    {
        $user = auth()->guard('admin')->user();
        if (!in_array($user->role, ['super_admin', 'god_admin'])) {
            abort(403, 'Unauthorized');
        }
        try {
            $caseStudy = CaseStudy::findOrFail($id);
            $caseStudy->delete();

            // Clear the cache
            Cache::forget('case_studies_featured');
            IndexNowHelper::pingUrl(url('/portfolio'));
            return response()->json([
                'success' => true,
                'message' => 'Case study deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting case study: ' . $e->getMessage()
            ], 422);
        }
    }
    public function manageAchievements()
    {
        $user = auth()->guard('admin')->user();
        if (!in_array($user->role, ['super_admin','admin', 'god_admin'])) {
            abort(403, 'Unauthorized');
        }
        $achievements = Achievement::all();
        return view('admin.portfolio.manage-achivements', compact('achievements'));
    }
    public function updateAchievement(Request $request, $id)
    {
        $user = auth()->guard('admin')->user();
        if (!in_array($user->role, ['super_admin','admin', 'god_admin'])) {
            abort(403, 'Unauthorized');
        }
        try {
            $achievement = Achievement::findOrFail($id);
            $achievement->number = $request->number;
            $achievement->label = $request->label;
            $achievement->description = $request->description;
            $achievement->save();
Cache::forget('achievements');
            return response()->json([
                'success' => true,
                'message' => 'Achievement updated successfully',
                'achievement' => $achievement
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating achievement: ' . $e->getMessage()
            ], 422);
        }
    }
}