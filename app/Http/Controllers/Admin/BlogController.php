<?php

namespace App\Http\Controllers\Admin;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\Admin\BlogRequest;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::with('category')->paginate(5);

        return view('admin.blogs.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::get(['name', 'id']);

        return view('admin.blogs.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BlogRequest $request)
    {
        if ($request->validated()) {
            $imageData = ['slug' => Str::slug($request->title, '-'), 'image' => null]; // Inisialisasi dengan null

            // Simpan featured image jika ada
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('blog/images', 'public');
                $imageData['image'] = $imagePath;
            }

            $blog = Blog::create($request->except('image', 'images') + $imageData);

            // Simpan gambar galeri jika ada
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $path = $image->store('blog/images/galleries', 'public');
                    $blog->blogImages()->create(['image_path' => $path]);
                }
            }

            return redirect()->route('admin.blogs.index')->with([
                'message' => 'Success Created !',
                'alert-type' => 'success'
            ]);
        }

        return redirect()->back()->withInput()->withErrors($request->validator);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        $categories = Category::get(['name', 'id']);
        $blog->load('category', 'blogImages'); // Tambahkan ini
        return view('admin.blogs.edit', compact('blog', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BlogRequest $request, Blog $blog)
    {
        if ($request->validated()) {
            $slug = Str::slug($request->title, '-');
            if ($request->image) {
                File::delete('storage/' . $blog->image);
                $image = $request->file('image')->store(
                    'blog/images',
                    'public'
                );
                $blog->update($request->except('image') + ['slug' => $slug, 'image' => $image]);
            } else {
                $blog->update($request->validated() + ['slug' => $slug]);
            }
        }

        return redirect()->route('admin.blogs.index')->with([
            'message' => 'Success Updated !',
            'alert-type' => 'info'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        File::delete('storage/' . $blog->image);
        $blog->delete();

        return redirect()->back()->with([
            'message' => 'Success Deleted !',
            'alert-type' => 'danger'
        ]);
    }
}
