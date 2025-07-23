<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::with(['subs' => function ($q) {
            $q->where('status', 1);
        }])
            ->where('status', 1)
            ->latest()
            ->take(9)
            ->get();

        $sliders = Slider::where('status', 1)->latest()->get();
        $flash_sales = Product::where('status', 1)->where('flash_sales', 1)->get(); //Trending
        $best_sell = Product::where('status', 1)->where('best_sell', 1)->get();
        $explore = Product::where('status', 1)->where('explore', 1)->take(8)->get();

        // এখানে meta ফিল্ডকে object বানিয়ে নিচ্ছি
        $top = Banner::where('status', 1)
            ->where('position', 'top')
            ->get()
            ->map(function ($banner) {
                $banner->meta = json_decode($banner->meta); // 👈 JSON থেকে object
                return $banner;
            });

        return Inertia::render('Home', [
            'sliders' => $sliders,
            'categories' => $categories,
            'flash_sales' => $flash_sales,
            'best_sell' => $best_sell,
            'explore' => $explore,
            'top' => $top,
        ]);
    }

    // view all product
    public function allproducts(Request $request)
    {

        $query = Product::where('status', 1);

        if ($request->filled('minPrice')) {
            $query->where('original_price', '>=', $request->minPrice);
        }

        if ($request->filled('maxPrice')) {
            $query->where('original_price', '<=', $request->maxPrice);
        }

        if ($request->sort === 'low') {
            $query->orderBy('original_price', 'asc');
        } elseif ($request->sort === 'high') {
            $query->orderBy('original_price', 'desc');
        }

        $products = $query->paginate(50)->withQueryString();

        return Inertia::render('client_side/view_all_product/AllProduct', [
            'products' => $products
        ]);
    }

    // view all category
    public function allcategories()
    {
        $categories = Category::where('status', 1)->select('id', 'name', 'image')->latest()->get();

        return Inertia::render('client_side/category/AllCategory', [
            'categories' => $categories
        ]);
    }
}
