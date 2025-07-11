<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AdminController\BannerController;
use App\Http\Controllers\AdminController\BrandController;
use App\Http\Controllers\AdminController\CategoryController;
use App\Http\Controllers\AdminController\ProductController;
use App\Http\Controllers\AdminController\SliderController;
use App\Http\Controllers\AdminController\SubController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductFilterController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/',[HomeController::class,'index'])->name('home');

// Route::get('/', function () {
//     return Inertia::render('Welcome');
// })->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::resource('sliders', SliderController::class);

Route::resource('categories',CategoryController::class);
Route::resource('subs',SubController::class);
Route::resource('brands',BrandController::class);
Route::resource('products',ProductController::class);
Route::resource('banners',BannerController::class);
Route::get('/allproducts',[HomeController::class, 'allproducts'])->name('products.all');
Route::get('/allcategories',[HomeController::class, 'allcategories'])->name('categories.all');
Route::get('/abouts',[AboutController::class, 'index'])->name('about');
Route::get('/contacts',[ContactController::class, 'index'])->name('contact');
// filtercontroller 
Route::get('/category/{category:slug}', [ProductFilterController::class, 'category'])->name('products.byCategory');

Route::get('/sub-Category/{sub}',[ProductFilterController::class, 'sub'])->name('products.bySub');
Route::get('/brand/{brand}',[ProductFilterController::class, 'brand'])->name('products.byBrand');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
