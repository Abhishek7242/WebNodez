<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class OgImageController extends Controller
{
    private function checkSuperAdmin()
    {
        $user = auth()->guard('admin')->user();
        if ($user->role !== 'super_admin') {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }
        return null;
    }

    public function index()
    {
        $check = $this->checkSuperAdmin();
        if ($check) return $check;

        $images = [];
        $imagePath = public_path('images');

        if (File::exists($imagePath)) {
            $files = File::files($imagePath);
            foreach ($files as $file) {
                if (in_array($file->getExtension(), ['jpg', 'jpeg', 'png', 'gif'])) {
                    $images[] = [
                        'name' => $file->getFilename(),
                        'path' => '/images/' . $file->getFilename(),
                        'size' => $this->formatSize($file->getSize()),
                        'last_modified' => date('Y-m-d H:i:s', $file->getMTime())
                    ];
                }
            }
        }

        return view('admin.manage-og-images', compact('images'));
    }

    public function upload(Request $request)
    {
        $check = $this->checkSuperAdmin();
        if ($check) return $check;

        $request->validate([
            'page' => 'required|string|in:home,about,services,portfolio,blog,contact,pricing,terms,privacy,web-development,app-development,e_commerse,ui-ux-design',
            'image_type' => 'required|string|in:og-image,banner,featured,thumbnail,background',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048'
        ]);

        $page = $request->input('page');
        $imageType = $request->input('image_type');
        $filename = $page . '-' . $imageType . '.jpg';
        $path = public_path('images/' . $filename);

        // Check if file already exists
        if (file_exists($path)) {
            return response()->json([
                'status' => 'error',
                'message' => 'An image with this name already exists'
            ], 422);
        }

        try {
            // Get the uploaded image
            $image = $request->file('image');

            // Create image resource based on file type
            switch ($image->getClientOriginalExtension()) {
                case 'png':
                    $sourceImage = imagecreatefrompng($image->getPathname());
                    break;
                case 'gif':
                    $sourceImage = imagecreatefromgif($image->getPathname());
                    break;
                case 'webp':
                    $sourceImage = imagecreatefromwebp($image->getPathname());
                    break;
                case 'jpg':
                case 'jpeg':
                    $sourceImage = imagecreatefromjpeg($image->getPathname());
                    break;
                default:
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Unsupported image format'
                    ], 422);
            }

            // Get original dimensions
            $width = imagesx($sourceImage);
            $height = imagesy($sourceImage);

            // Create new image with white background
            $newImage = imagecreatetruecolor($width, $height);
            $white = imagecolorallocate($newImage, 255, 255, 255);
            imagefill($newImage, 0, 0, $white);

            // Copy and merge the original image onto the new image
            imagecopy($newImage, $sourceImage, 0, 0, 0, 0, $width, $height);

            // Save as JPG with high quality
            imagejpeg($newImage, $path, 90);

            // Free up memory
            imagedestroy($sourceImage);
            imagedestroy($newImage);

            return response()->json([
                'status' => 'success',
                'message' => 'Image uploaded successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to upload image: ' . $e->getMessage()
            ], 500);
        }
    }

    public function delete($filename)
    {
        $check = $this->checkSuperAdmin();
        if ($check) return $check;

        try {
            $filepath = public_path('images/' . $filename);

            if (File::exists($filepath)) {
                File::delete($filepath);
                return response()->json([
                    'status' => 'success',
                    'message' => 'Image deleted successfully'
                ]);
            }

            return response()->json([
                'status' => 'error',
                'message' => 'Image not found'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to delete image: ' . $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $filename)
    {
        $check = $this->checkSuperAdmin();
        if ($check) return $check;

        $request->validate([
            'new_filename' => 'required|string|regex:/^[a-zA-Z0-9-]+\.jpg$/'
        ]);

        $oldPath = public_path('images/' . $filename);
        $newPath = public_path('images/' . $request->new_filename);

        if (!file_exists($oldPath)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Image not found'
            ], 404);
        }

        if (file_exists($newPath)) {
            return response()->json([
                'status' => 'error',
                'message' => 'An image with this name already exists'
            ], 422);
        }

        if (rename($oldPath, $newPath)) {
            return response()->json([
                'status' => 'success',
                'message' => 'Image renamed successfully'
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Failed to rename image'
        ], 500);
    }

    private function formatSize($size)
    {
        $units = ['B', 'KB', 'MB', 'GB'];
        $i = 0;
        while ($size >= 1024 && $i < count($units) - 1) {
            $size /= 1024;
            $i++;
        }
        return round($size, 2) . ' ' . $units[$i];
    }
}