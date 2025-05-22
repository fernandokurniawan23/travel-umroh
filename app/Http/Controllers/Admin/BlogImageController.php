<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BlogImageRequest; // Kita akan buat request ini nanti
use App\Models\Blog;
use App\Models\BlogImage;
use Illuminate\Support\Facades\File;

class BlogImageController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(BlogImageRequest $request, Blog $blog)
    {
        if ($request->validated()) {
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $path = $image->store('blog/images/galleries', 'public');
                    BlogImage::create([
                        'blog_id' => $blog->id,
                        'image_path' => $path,
                    ]);
                }
            }
        }

        return redirect()->route('admin.blogs.edit', [$blog])->with([
            'message' => 'Gambar berhasil ditambahkan!',
            'alert-type' => 'success',
        ]);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog, BlogImage $blog_image)
    {
        \Log::info('Attempting to delete image with ID: ' . $blog_image->id . ' for blog ID: ' . $blog->id);
        \Log::info('Image path: ' . $blog_image->image_path);

        File::delete('storage/' . $blog_image->image_path);
        $deleted = $blog_image->delete();

        \Log::info('Database deletion successful: ' . ($deleted ? 'yes' : 'no'));

        return redirect()->back()->with([
            'message' => 'Gambar berhasil dihapus!',
            'alert-type' => 'danger',
        ]);
    }
}