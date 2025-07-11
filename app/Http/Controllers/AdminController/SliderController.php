<?php

namespace App\Http\Controllers\AdminController;

use App\Models\Slider;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest\Slider\StoreSliderRequest as SliderStoreSliderRequest;
use App\Http\Requests\AdminRequest\Slider\UpdateSliderRequest as SliderUpdateSliderRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Inertia\Inertia;

class SliderController extends Controller

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
        $query = Slider::query();

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
        $sliders = $query->orderBy('created_at', 'desc')->paginate(10)->withQueryString();

        // ফিল্টার তথ্য প্রেরণ
        $filters = [
            'search' => $search,
            'status' => $status,
        ];

        return Inertia::render('admin_pages/slider/Index', [
            'sliders' => $sliders,
            'filters' => $filters,
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('admin_pages/slider/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SliderStoreSliderRequest $request)
    {
        Slider::create($request->validated());

        return redirect()->route('sliders.index')
            ->with('success', 'Slider Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Slider $slider) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Slider $slider)
    {
        return Inertia::render('admin_pages/slider/Edit', [
            'slider' => $slider,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SliderUpdateSliderRequest $request, Slider $slider)
    {
        $slider->Update($request->validated());

        return redirect()->route('sliders.index')
            ->with('success', 'Slider Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Slider $slider)
    {
        $slider->delete();
        return redirect()->route('sliders.index')
            ->with('success', 'Slider  Successfully');
    }
}
