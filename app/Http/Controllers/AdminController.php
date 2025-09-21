<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\News;
use App\Models\User;

class AdminController extends Controller
{
    public function dashboard(Request $request)
    {
        // Build query for news with search and filter
        $query = News::with(['category', 'user']);
        
        // Search functionality
        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }
        
        // Status filter
        if ($request->filled('status')) {
            $query->where('status', $request->get('status'));
        }
        
        // Get paginated news
        $news = $query->latest()->paginate(10)->withQueryString();
        
        // Dashboard statistics
        $stats = [
            'total_news' => News::count(),
            'published_news' => News::where('status', 'published')->count(),
            'draft_news' => News::where('status', 'draft')->count(),
            'total_categories' => Category::count(),
            'total_users' => User::count(),
            'admin_users' => User::where('is_admin', true)->count(),
        ];
        
        // Recent news (last 5)
        $recent_news = News::with(['category', 'user'])
            ->latest()
            ->take(5)
            ->get();
        
        // News by status for chart
        $news_by_status = [
            'published' => News::where('status', 'published')->count(),
            'draft' => News::where('status', 'draft')->count(),
        ];
        
        // News by category
        $news_by_category = Category::withCount('news')->get();
        
        return view('admin.dashboard', compact('news', 'stats', 'recent_news', 'news_by_status', 'news_by_category'));
    }

//   public function create()
// {
//     // $categories = Category::all();
//     // return view('admin.create', compact('categories'));
// }

    public function store(Request $request)
{
    $request->validate([
        'title' => 'required',
        'content' => 'required',
        'status' => 'required|in:draft,published',
        'categories_id' => 'required|exists:categories,id',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $data = $request->only('title', 'content', 'status', 'categories_id');
    $data['user_id'] = Auth::id(); // set the admin as creator

    // Image upload
    if($request->hasFile('image')){
        $file = $request->file('image');
        $filename = time().'_'.$file->getClientOriginalName();
        $file->move(public_path('uploads/news'), $filename);
        $data['image'] = $filename;
    }

    News::create($data);

    return redirect()->route('admin.dashboard')->with('success', 'News created successfully!');
}

    public function edit($id)
    {
        $news = News::findOrFail($id);
        return view('admin.edit', compact('news'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $news = News::findOrFail($id);
        $news->update($request->only('title', 'content'));

        return redirect()->route('admin.dashboard')->with('success', 'News updated successfully!');
    }

    public function destroy($id)
    {
        $news = News::findOrFail($id);
        $news->delete();

        return redirect()->route('admin.dashboard')->with('error', 'News deleted successfully!');
    }

    public function toggleStatus($id)
    {
        try {
            $news = News::findOrFail($id);
            $news->status = $news->status === 'published' ? 'draft' : 'published';
            $news->save();

            return response()->json([
                'success' => true,
                'message' => "News status updated to {$news->status} successfully!",
                'new_status' => $news->status
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while updating the status.'
            ], 500);
        }
    }

    //User
    
    // Show all users
    public function users()
    {
        $users = User::orderBy('id', 'desc')->paginate(10);
        return view('admin.users.index',compact('users'));
    }


    // Edit user form
    public function editUser($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    // Update user
    public function updateUser(Request $request, $id)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'is_admin' => 'required|boolean',
        ]);

        $user = User::findOrFail($id);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->is_admin = $request->is_admin;

        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully!');
    }

    // Delete user
    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }




    


    
}