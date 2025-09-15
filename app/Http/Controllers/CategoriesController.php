<?php

namespace App\Http\Controllers;

use App\Models\categories;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function categories(){
        // $categories = categories::all();
        // return view('admin.category.index', compact('categories'));
        $categories = Category::orderByDesc('id')->get();
        return view('admin.category.index', compact('categories'));
    }
    public function addCategory(){
        return view('admin.category.create');
    }
    // Store Category in DB
    public function storeCategory(Request $request)
        {
            $request->validate([
                'name' => 'required|unique:categories|max:255',
            ]);

            Category::create([
                'name' => $request->name,
            ]);

            return redirect()->route('categories.index')->with('success', 'Category added successfully.');
        }

    // Show edit form
    public function editCategory($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.category.edit', compact('category'));
    }

    // Update category
    public function updateCategory(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $request->validate([
            'name' => 'required|unique:categories,name,' . $id . '|max:255',
        ]);

        $category->update([
            'name' => $request->name,
        ]);

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    // Delete category
    public function deleteCategory($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}
