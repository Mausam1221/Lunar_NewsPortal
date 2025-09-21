<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\News;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $latestNews = News::where('status', 'published')
            ->latest()
            ->take(5)
            ->get();

        $categories = Category::all(); // fetch all categories

        return view('home', compact('latestNews', 'categories'));    
    }
    public function show($id)
    {
        $news = News::where('status', 'published')->findOrFail($id);
        return view('show', compact('news'));
    }

    public function categoryNews($id)
    {
        $category = Category::findOrFail($id);
        $news = News::where('status', 'published')
            ->where('categories_id', $id)
            ->latest()
            ->get();
        
        $categories = Category::all();
        
        return view('category-news', compact('news', 'category', 'categories'));
    }
}
