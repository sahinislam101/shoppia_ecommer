<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Sub;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductFilterController extends Controller
{
    public function category(Category $category)
    {
        $products = Product::where('category_id', $category->id)
            ->where('status', 1)
            ->with('brand', 'category', 'sub')
            ->paginate(20)
            ->withQueryString();

        return Inertia::render('client_side/product/CategoryProduct', [
            'products' => $products,
            'title' => $category->name,
        ]);
    }

    public function sub(Sub $sub)
    {
        $products = Product::where('sub_id', $sub->id)
            ->where('status', 1)
            ->with('brand', 'category', 'sub')
            ->paginate(20)
            ->withQueryString();

        return Inertia::render('client_side/product/SubProduct', [
            'products' => $products,
            'title' => $sub->name,
        ]);
    }

    public function brand(Brand $brand)
    {
        $products = Product::where('brand_id', $brand->id)
            ->where('status', 1)
            ->with('brand', 'category', 'sub')
            ->paginate(20)
            ->withQueryString();

        return Inertia::render('client_side/product/BrandProduct', [
            'products' => $products,
            'title' => $brand->name,
        ]);
    }
}