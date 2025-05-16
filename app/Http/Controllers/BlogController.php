<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\TravelPackage;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::get();

        return view('blogs.index', compact('blogs'));
    }

    public function show(Blog $blog)
    {
        $relatedBlogs = Blog::where('id', '!=', $blog->id)
            ->when($blog->category_id, function ($query) use ($blog) {
                $query->where('category_id', $blog->category_id);
            })
            ->latest()
            ->take(3)
            ->get();

        $categories = Category::get();
        $travel_packages = TravelPackage::with('galleries')->take(2)->get();

        $blog->incrementReadCount();

        return view('blogs.show', compact('blog', 'travel_packages', 'relatedBlogs', 'categories'));
    }


    public function category(Category $category)
    {
        $blogs = Blog::where('category_id', $category->id)->get();

        return view('blogs.category', compact('blogs', 'category'));
    }
}
