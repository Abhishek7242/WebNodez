<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Blog;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cache;

class AdminManageBlogController extends Controller
{
    public function index()
    {
        $user = auth()->guard('admin')->user();
        if (!in_array($user->role, ['super_admin', 'admin','editor', 'god_admin'])) {
            abort(403, 'Unauthorized');
        }
        $blogs = Cache::remember('admin.blogs.all', 3600, function () {
            return Blog::latest()->get();
        });
        return view('admin.blog-list', compact('blogs'));
    }

    public function blogs()
    {
        $blogs = Cache::remember('frontend.featured.blogs', 3600, function () {
            return Blog::where('is_featured', 1)->latest()->get();
        });

        return view('frontend.blogs', compact('blogs'));
    }

    public function newBlog()
    {
        $user = auth()->guard('admin')->user();
        if (!in_array($user->role, ['super_admin', 'admin', 'editor', 'god_admin'])) {
            abort(403, 'Unauthorized');
        }
        Cache::forget('admin.blogs.all');
        return view('admin.new-blog');
    }

    public function editBlog($id)
    {
        $user = auth()->guard('admin')->user();
        if (!in_array($user->role, ['super_admin', 'admin','editor', 'god_admin'])) {
            abort(403, 'Unauthorized');
        }
        $blog = Cache::remember('blog.' . $id, 3600, function () use ($id) {
            return Blog::findOrFail($id);
        });
        Cache::forget('admin.blogs.all');
        Cache::forget('blog.' . $id);
        return view('admin.blog-page-edit', compact('blog'));
    }

    public function updateBlog(Request $request, $id)
    {
        $user = auth()->guard('admin')->user();
        if (!in_array($user->role, ['super_admin', 'admin','editor', 'god_admin'])) {
            abort(403, 'Unauthorized');
        }
        $blog = Blog::findOrFail($id);

        // Validate the request
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:blogs,slug,' . $id,
            'category' => 'required|string|max:100',
            'content' => 'required|string',
            'featured_image' => 'nullable|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            // Handle featured image upload if present
            if ($request->hasFile('featured_image')) {
                // Delete old image if exists
                if ($blog->featured_image) {
                    $oldPath = str_replace('/storage/', '', $blog->featured_image);
                    Storage::disk('public')->delete($oldPath);
                }

                $file = $request->file('featured_image');
                $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('blog-images', $filename, 'public');
                $blog->featured_image = Storage::url($path);
            }

            // Update blog post
            $blog->update([
                'title' => $request->title,
                'slug' => $request->slug,
                'category' => $request->category,
                'content' => $request->content,
                'is_featured' => $request->boolean('is_featured', false),
                'status' => 'published'
            ]);

            // Clear related caches
            Cache::forget('blog.' . $id);
            Cache::forget('blog.slug.' . $request->slug);
            
            Cache::forget('admin.blogs.all');
            Cache::forget('frontend.featured.blogs');

            return redirect()->route('admin.blog.list')->with('success', 'Blog updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error updating blog: ' . $e->getMessage());
        }
    }

    public function uploadImage(Request $request)
    {
        $user = auth()->guard('admin')->user();
        if (!in_array($user->role, ['super_admin', 'admin','editor', 'god_admin'])) {
            abort(403, 'Unauthorized');
        }
        if (!$request->hasFile('file')) {
            return response()->json(['error' => 'No file uploaded'], 400);
        }

        $file = $request->file('file');

        // Validate file
        $request->validate([
            'file' => 'required|image|max:2048'
        ]);

        // Generate unique filename
        $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();

        // Store file in public disk under blog-images directory
        $path = $file->storeAs('blog-images', $filename, 'public');

        // Return the URL of the stored file
        return response()->json([
            'location' => Storage::url($path)
        ]);
    }

    public function saveBlog(Request $request)
    {
        $user = auth()->guard('admin')->user();
        if (!in_array($user->role, ['super_admin', 'admin','editor', 'god_admin'])) {
            abort(403, 'Unauthorized');
        }
            // Validate the request
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:blogs,slug',
            'category' => 'required|string|max:100',
            'content' => 'required|string',
            'featured_image' => 'nullable|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            // Handle featured image upload if present
            $featuredImagePath = null;
            if ($request->hasFile('featured_image')) {
                $file = $request->file('featured_image');
                $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();
                $featuredImagePath = $file->storeAs('blog-images', $filename, 'public');
            }

            // Create the blog post
            $blog = Blog::create([
                'title' => $request->title,
                'slug' => $request->slug,
                'category' => $request->category,
                'content' => $request->content,
                'featured_image' => $featuredImagePath ? Storage::url($featuredImagePath) : null,
                'is_featured' => $request->boolean('is_featured', false),
                'status' => 'published',
                'author_id' => auth()->guard('admin')->id()
            ]);

            // Clear related caches
            Cache::forget('admin.blogs.all');
            Cache::forget('frontend.featured.blogs');

            return redirect()->back()->with('success', 'Blog saved!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'ERROR! Blog not Saved!');
        }
    }

    public function deleteBlog($id)
    {
        $user = auth()->guard('admin')->user();
        if (!in_array($user->role, ['super_admin', 'admin','editor', 'god_admin'])) {
            abort(403, 'Unauthorized');
        }
        $blog = Blog::findOrFail($id);
        $blog->delete();

        // Clear related caches
        Cache::forget('blog.' . $id);
        Cache::forget('admin.blogs.all');
        Cache::forget('frontend.featured.blogs');

        return redirect()->back()->with('success', 'Blog deleted successfully!');
    }

    public function viewBlog($id)
    {
        $user = auth()->guard('admin')->user();
        if (!in_array($user->role, ['super_admin', 'admin','editor', 'god_admin'])) {
            abort(403, 'Unauthorized');
        }
        $blog = Cache::remember('blog.' . $id, 3600, function () use ($id) {
            return Blog::findOrFail($id);
        });
        Cache::forget('blog.' . $id);
        return view('admin.blog-view', compact('blog'));
    }

    public function userBlogView($slug)
    {
        $blog = Cache::remember('blog.slug.' . $slug, 3600, function () use ($slug) {
            return Blog::where('slug', $slug)->firstOrFail();
        });
        $blogs = Cache::remember('frontend.featured.blogs', 3600, function () {
            return Blog::where('is_featured', 1)->latest()->get();
        });
        return view('frontend.blog-page', compact('blog', 'blogs'));
    }
}