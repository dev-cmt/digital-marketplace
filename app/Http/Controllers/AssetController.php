<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Helpers\ImageHelper;

class AssetController extends Controller
{
    public function index()
    {
        $assets = Asset::with('category')->latest()->paginate(20);
        return view('backend.assets.index', compact('assets'));
    }

    public function create()
    {
        $categories = Category::active()->orderBy('order')->get();
        return view('backend.assets.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'type' => 'nullable|in:photo,video,audio,vector,3d,template',
            'resolution' => 'nullable|string|max:255',
            'license' => 'nullable|string|max:255',
            'price' => 'nullable|numeric|min:0',
            'is_free' => 'nullable|boolean',
            'thumbnail' => 'required|image|mimes:jpeg,jpg,png,webp|max:2048',
            'preview_url' => 'nullable|file|max:204800', // 200MB limit for preview
            'file_path' => 'nullable|file|max:512000', // 500MB limit for source file
            'description' => 'nullable|string',
        ]);

        $asset = new Asset();
        $asset->category_id = $request->category_id;
        $asset->title = $request->title;
        $asset->slug = Str::slug($request->title) . '-' . uniqid();
        $asset->type = $request->type;
        $asset->resolution = $request->resolution;
        $asset->license = $request->license ?? 'Standard Commercial License';
        $asset->price = $request->has('is_free') ? 0 : ($request->price ?? 0);
        $asset->is_free = $request->has('is_free');
        $asset->description = $request->description;
        $asset->is_active = $request->has('is_active');
        $asset->is_trending = $request->has('is_trending');

        if ($request->hasFile('thumbnail')) {
            $asset->thumbnail = ImageHelper::uploadImage($request->file('thumbnail'), 'uploads/assets/thumbnails');
        }

        if ($request->hasFile('preview_url')) {
            $asset->preview_url = ImageHelper::uploadImage($request->file('preview_url'), 'uploads/assets/previews');
            
            // Auto-detect type if not provided manually
            if (!$request->type) {
                $extension = strtolower($request->file('preview_url')->getClientOriginalExtension());
                if (in_array($extension, ['jpg', 'jpeg', 'png', 'webp', 'gif'])) {
                    $asset->type = 'photo';
                } elseif (in_array($extension, ['mp4', 'mov', 'avi', 'mpeg'])) {
                    $asset->type = 'video';
                } elseif (in_array($extension, ['mp3', 'wav', 'ogg'])) {
                    $asset->type = 'audio';
                } elseif (in_array($extension, ['zip', 'rar', 'psd', 'ai', 'eps'])) {
                    $asset->type = 'template';
                }
            }
        }

        if ($request->hasFile('file_path')) {
            $asset->file_path = ImageHelper::uploadImage($request->file('file_path'), 'uploads/assets/source');
        }

        $asset->save();

        return redirect()->route('assets.index')->with('success', 'Asset created successfully.');
    }

    public function edit($id)
    {
        $asset = Asset::findOrFail($id);
        $categories = Category::active()->orderBy('order')->get();
        return view('backend.assets.edit', compact('asset', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'type' => 'nullable|in:photo,video,audio,vector,3d,template',
            'resolution' => 'nullable|string|max:255',
            'license' => 'nullable|string|max:255',
            'price' => 'nullable|numeric|min:0',
            'thumbnail' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
            'preview_url' => 'nullable|file|max:204800', // 200MB
            'file_path' => 'nullable|file|max:512000', // 500MB
        ]);

        $asset = Asset::findOrFail($id);
        $asset->category_id = $request->category_id;
        $asset->title = $request->title;
        $asset->type = $request->type;
        $asset->resolution = $request->resolution;
        $asset->license = $request->license ?? $asset->license;
        $asset->price = $request->has('is_free') ? 0 : ($request->price ?? 0);
        $asset->is_free = $request->has('is_free');
        $asset->description = $request->description;
        $asset->is_active = $request->has('is_active');
        $asset->is_trending = $request->has('is_trending');

        if ($request->hasFile('thumbnail')) {
            $asset->thumbnail = ImageHelper::uploadImage($request->file('thumbnail'), 'uploads/assets/thumbnails', $asset->thumbnail);
        }

        if ($request->hasFile('preview_url')) {
            $asset->preview_url = ImageHelper::uploadImage($request->file('preview_url'), 'uploads/assets/previews', $asset->preview_url);

            // Auto-detect type if not provided manually
            if (!$request->type) {
                $extension = strtolower($request->file('preview_url')->getClientOriginalExtension());
                if (in_array($extension, ['jpg', 'jpeg', 'png', 'webp', 'gif'])) {
                    $asset->type = 'photo';
                } elseif (in_array($extension, ['mp4', 'mov', 'avi', 'mpeg'])) {
                    $asset->type = 'video';
                } elseif (in_array($extension, ['mp3', 'wav', 'ogg'])) {
                    $asset->type = 'audio';
                } elseif (in_array($extension, ['zip', 'rar', 'psd', 'ai', 'eps'])) {
                    $asset->type = 'template';
                }
            }
        }

        if ($request->hasFile('file_path')) {
            $asset->file_path = ImageHelper::uploadImage($request->file('file_path'), 'uploads/assets/source', $asset->file_path);
        }

        $asset->save();

        return redirect()->route('assets.index')->with('success', 'Asset updated successfully.');
    }

    public function download($slug)
    {
        $asset = Asset::where('slug', $slug)->active()->firstOrFail();

        // Check if the asset is free
        if (!$asset->is_free) {
            return redirect()->back()->with('error', 'This is a premium asset. Please purchase it first.');
        }

        // Strictly prioritize Source File (file_path)
        $filePath = $asset->file_path;
        
        // Only fallback if source is missing
        if (!$filePath) {
            $filePath = $asset->preview_url ?? $asset->thumbnail;
        }

        if (!$filePath) {
            return redirect()->back()->with('error', 'No file available for download.');
        }

        // Increment count
        $asset->increment('downloads_count');

        // Handle External URLs
        if (filter_var($filePath, FILTER_VALIDATE_URL)) {
            return redirect()->to($filePath);
        }

        // Handle Local Files
        $fullPath = public_path($filePath);
        if (file_exists($fullPath)) {
            $extension = pathinfo($fullPath, PATHINFO_EXTENSION);
            $fileName = Str::slug($asset->title) . '.' . $extension;
            return response()->download($fullPath, $fileName);
        }

        return redirect()->back()->with('error', 'The file does not exist on the server.');
    }

    public function destroy($id)
    {
        $asset = Asset::findOrFail($id);
        
        ImageHelper::deleteImage($asset->thumbnail);
        ImageHelper::deleteImage($asset->preview_url);

        $asset->delete();

        return redirect()->back()->with('success', 'Asset deleted successfully.');
    }
}
