<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Sub extends Model
{
    use HasFactory;

    public $incrementing = false; // because we are using UUID
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'category_id',
        'name',
        'slug',
        'description',
        'status',
    ];

    // Auto-generate UUID and slug
    protected static function boot()
    {
        parent::boot();

        // When creating new Sub
        static::creating(function ($sub) {
            $sub->id = (string) Str::uuid();
            $sub->slug = Str::slug($sub->name);
        });

        // When updating existing Sub
        static::updating(function ($sub) {
            $sub->slug = Str::slug($sub->name);
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
    public function products()
{
    return $this->hasMany(Product::class);
}
}
