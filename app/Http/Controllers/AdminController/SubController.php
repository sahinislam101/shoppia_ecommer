<?php

namespace App\Http\Controllers\AdminController;

use App\Models\Sub;
use Inertia\Inertia;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest\sub\StoreSubRequest as StoreSubRequest;
use App\Http\Requests\AdminRequest\sub\UpdateSubRequest as UpdateSubRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class SubController extends Controller
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
        $query = Sub::query();

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
        $subs = $query->orderBy('created_at', 'desc')->paginate(10)->withQueryString();

        // ফিল্টার তথ্য প্রেরণ
        $filters = [
            'search' => $search,
            'status' => $status,
        ];

        return Inertia::render('admin_pages/sub/Index', [
            'subs' => $subs,
            'filters' => $filters,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::select('id', 'name')->get();

        return Inertia::render('admin_pages/sub/Create', [
            'categories' => $categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSubRequest $request)
    {
        Sub::create($request->validated());
        
        return redirect()->route('subs.index')
        ->with('success','Sub Created Successfully');
    }


    /**
     * Display the specified resource.
     */
    public function show(Sub $sub)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sub $sub)
    {
         $categories = Category::all();

        return Inertia::render('admin_pages/sub/Edit', [
            'sub' => $sub,
            'categories' => $categories,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSubRequest $request, Sub $sub)
    {
        $sub->update($request->validated());
        return redirect()->route('subs.index')
            ->with('success', 'Sub-Category Updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sub $sub)
    {
        $sub->delete();
        return redirect()->route('subs.index')
        ->with('success', 'Sub-Category Deleted Successfully');
    }
}
