<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Blog;
use Illuminate\Support\Facades\Validator;

class AdminManageBlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::latest()->get();
        return view('admin.blog-list', compact('blogs'));
    }
    public function blogs()
    {
        $blogs = Blog::latest()->get();
        return view('frontend.blogs', compact('blogs'));
    }

    public function newBlog()
    {
        return view('admin.new-blog');
    }

    public function editBlog($id)
    {
        $blog = Blog::findOrFail($id);
        return view('admin.blog-page-edit', compact('blog'));
    }

    public function updateBlog(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);

        // Validate the request
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:blogs,slug,' . $id,
            'category' => 'required|string|max:100',
            'content' => 'required|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_featured' => 'boolean'
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

            return redirect()->route('admin.blog.list')->with('success', 'Blog updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error updating blog: ' . $e->getMessage());
        }
    }

    public function uploadImage(Request $request)
    {
        if (!$request->hasFile('file')) {
            return response()->json(['error' => 'No file uploaded'], 400);
        }

        $file = $request->file('file');

        // Validate file
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
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
        // Validate the request
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:blogs,slug',
            'category' => 'required|string|max:100',
            'content' => 'required|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_featured' => 'boolean'
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

            return redirect()->back()->with('success', 'Blog saved!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'ERROR! Blog not Saved!');
        }
    }

    public function viewBlog($id)
    {
        $blog = Blog::findOrFail($id);
        return view('admin.blog-view', compact('blog'));
    }
    public function userBlogView($id)
    {
        $blog = Blog::findOrFail($id);
        return view('frontend.blog-page', compact('blog'));
    }
}