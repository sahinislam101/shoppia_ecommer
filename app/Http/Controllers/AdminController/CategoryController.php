<?php

namespace App\Http\Controllers\AdminController;

use Inertia\Inertia;
use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest\category\StoreCategoryRequest as StoreCategoryRequest;
use App\Http\Requests\AdminRequest\category\UpdateCategoryRequest as UpdateCategoryRequest;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // ফিল্টারগুলো নিন
        $search = $request->input('search', '');
        $status = $request->input('status', '');

        // Query শুরু
        $query = Category::query();

        // সার্চ ফিল্টার প্রয়োগ
        if ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        }

        // স্ট্যাটাস ফিল্টার প্রয়োগ
        if ($status === 'active') {
            $query->where('status', true);
        } elseif ($status === 'inactive') {
            $query->where('status', false);
        }

        // Pagination (ধরা হচ্ছে 10 per page)
        $categories = $query->orderBy('created_at', 'desc')->paginate(10)->withQueryString();

        // ফিল্টার তথ্য প্রেরণ
        $filters = [
            'search' => $search,
            'status' => $status,
        ];

        return Inertia::render('admin_pages/category/Index', [
            'categories' => $categories,
            'filters' => $filters,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         return Inertia::render('admin_pages/category/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        Category::create($request->validated());
        
        return redirect()->route('categories.index')
        ->with('success','Category Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return Inertia::render('admin_pages/category/Edit',[
            'category' => $category,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->update($request->validated());

        return redirect()->route('categories.index')
        ->with('success','Category Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('categories.index')
        ->with('success','Category Deleted Successfully');
    }
}
