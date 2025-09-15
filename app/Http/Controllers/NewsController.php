<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.create', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'        => 'required|string|max:255',
            'content'      => 'required|string',
            'status'       => 'required|in:draft,published',
            'categories_id' => 'required|exists:categories,id',
            'image'        => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();

            // Save to /public/uploads/news
            $file->move(public_path('uploads/news'), $filename);

            // Store path in DB
            $imagePath = 'uploads/news/' . $filename;
        }

        \App\Models\News::create([
            'title'         => $request->title,
            'content'       => $request->content,
            'status'        => $request->status,
            'categories_id' => $request->categories_id,
            'image'         => $imagePath,
            'user_id'       => Auth::id(),
        ]);

        return redirect()->back()->with('success', 'News created successfully!');
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
    public function edit($id)
    {
        $news = News::findOrFail($id);
        $categories = Category::orderBy('id', 'desc')->get();
        return view('admin.edit', compact('news', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title'        => 'required|string|max:255',
            'content'      => 'required|string',
            'status'       => 'required|in:draft,published',
            'categories_id' => 'required|exists:categories,id',
            'image'        => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $news = \App\Models\News::findOrFail($id);

        // Update basic fields
        $news->title = $request->title;
        $news->content = $request->content;
        $news->status = $request->status;
        $news->categories_id = $request->categories_id;

        // Handle image update
        if ($request->hasFile('image')) {
            // delete old image if exists
            if ($news->image && file_exists(public_path('storage/' . $news->image))) {
                unlink(public_path('storage/' . $news->image));
            }

            // store new image
            $imagePath = $request->file('image')->store('news_images', 'public');
            $news->image = $imagePath;
        }

        $news->save();

        return redirect()->route('admin.dashboard')->with('success', 'News updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
