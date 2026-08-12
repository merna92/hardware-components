<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'category_id',
        'brand_id',
        'product_name',
        'description',
        'price',
        'stock_quantity',
        'warranty_period',
        'image_url',
        'release_date',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'stock_quantity' => 'integer',
            'release_date' => 'date',
        ];
    }

    // Relationships
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class);
    }

    public function primaryImage(): HasOne
    {
        return $this->hasOne(ProductImage::class)->where('is_primary', true);
    }

    public function cartItems(): HasMany
    {
        return $this->hasMany(CartItem::class);
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function wishedByUsers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'wishlists')->withTimestamps();
    }

    // Scopes
    public function scopeAvailable($query)
    {
        return $query->where('status', 'Available')->where('stock_quantity', '>', 0);
    }

    // Helper for main image URL fallback
    public function getImageUrlAttribute($value): string
    {
        if (!empty($value)) {
            return $value;
        }

        $primary = $this->primaryImage;
        if ($primary && $primary->image_url) {
            return $primary->image_url;
        }

        $firstImage = $this->images->first();
        if ($firstImage && $firstImage->image_url) {
            return $firstImage->image_url;
        }

        return 'https://via.placeholder.com/600x400?text=' . urlencode($this->product_name ?? 'Hardware+Product');
    }
}
