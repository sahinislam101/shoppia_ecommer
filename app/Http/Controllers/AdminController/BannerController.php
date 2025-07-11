<?php

namespace App\Http\Controllers\AdminController;

use App\Models\Banner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest\banner\StoreBannerRequest as StoreBannerRequest;
use App\Http\Requests\AdminRequest\banner\UpdateBannerRequest as UpdateBannerRequest;
use Inertia\Inertia;

class BannerController extends Controller
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
        $query = Banner::query();

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
        $banners = $query->orderBy('created_at', 'desc')->paginate(10)->withQueryString();

        // ফিল্টার তথ্য প্রেরণ
        $filters = [
            'search' => $search,
            'status' => $status,
        ];

        return Inertia::render('admin_pages/banner/Index', [
            'banners' => $banners,
            'filters' => $filters,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('admin_pages/banner/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBannerRequest $request)
    {
        Banner::create($request->validated());

        return redirect()->route('banners.index')
        ->with('success','Banner Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Banner $banner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Banner $banner)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBannerRequest $request, Banner $banner)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Banner $banner)
    {
        $banner->delete();
    }
}
