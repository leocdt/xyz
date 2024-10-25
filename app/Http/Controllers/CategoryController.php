<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Track;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(): View
    {
        $categories = Category::withCount('tracks')->get();
        return view('app.categories.index', compact('categories'));
    }

    public function show(Category $category): View
    {
        $tracks = $category->tracks()
            ->with(['user', 'week'])
            ->withCount('likes')
            ->orderByDesc('likes_count')
            ->paginate(15);

        return view('app.categories.show', compact('category', 'tracks'));
    }
}
