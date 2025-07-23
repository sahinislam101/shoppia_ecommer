<?php

namespace App\Http\Controllers\AdminController;

use App\Models\Sub;
use Inertia\Inertia;
;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest\product\StoreProductRequest as StoreProductRequest;
use App\Http\Requests\AdminRequest\product\UpdateProductRequest as UpdateProductRequest;

class ProductController extends Controller
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
        $query = Product::query();

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
        $products = $query->orderBy('created_at', 'desc')->paginate(10)->withQueryString();

        // ফিল্টার তথ্য প্রেরণ
        $filters = [
            'search' => $search,
            'status' => $status,
        ];

        return Inertia::render('admin_pages/product/Index', [
            'products' => $products,
            'filters' => $filters,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       return Inertia::render('admin_pages/product/Create',[
        'categories' => Category::select('id', 'name')->get(),
        'subs' => Sub::select('id', 'name')->get(),
        'brands' => Brand::select('id', 'name')->get(),
       ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {

        Product::create($request->validated());

        return redirect()->route('products.index')
            ->with('success', 'Product Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        
        return Inertia::render('admin_pages/product/Edit',[
            'product'=>$product,
            'flash_sales' => $product->flash_sales,
            'best_sell' => $product->best_sell,
            'explore' => $product->explore,
            'categories'=>Category::select('id','name')->get(),
            'subs'=>Sub::select('id','name')->get(),
            'brands'=>Brand::select('id','name')->get(), 
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->update($request->validated());
        return redirect()->route('products.index')
            ->with('success', 'Product Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')
            ->with('success', 'Product Deleted Successfully');
    }
}
