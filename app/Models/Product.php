<?php

namespace App\Models;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory, HasUuids, HasSlug;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'name',
        'slug',
        'description',
        'small_description',
        'original_price',
        'selling_price',
        'stock',
        'image',
        'category_id',
        'sub_id',
        'brand_id',
        'explore',
        'flash_sales',
        'best_sell',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
        'explore' => 'boolean',
        'flash_sales' => 'boolean',
        'best_sell' => 'boolean',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate();
    }

    // 🔗 Relationships
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function sub()
    {
        return $this->belongsTo(Sub::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}
