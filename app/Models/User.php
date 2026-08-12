<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'first_name',
        'last_name',
        'name',
        'email',
        'phone',
        'phone_number',
        'role',
        'role_type',
        'avatar',
        'password',
        'last_login',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'last_login' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Role compatibility accessors/mutators
    public function getRoleTypeAttribute(): string
    {
        return ucfirst($this->role ?? $this->attributes['role_type'] ?? 'Customer');
    }

    public function setRoleTypeAttribute($value): void
    {
        $this->attributes['role_type'] = $value;
        $this->attributes['role'] = strtolower($value);
    }

    public function getPhoneNumberAttribute(): ?string
    {
        return $this->phone ?? $this->attributes['phone_number'] ?? null;
    }

    public function setPhoneNumberAttribute($value): void
    {
        $this->attributes['phone_number'] = $value;
        $this->attributes['phone'] = $value;
    }

    public function isAdmin(): bool
    {
        $role = strtolower($this->role ?? $this->role_type ?? '');
        return $role === 'admin';
    }

    public function permissions(): array
    {
        return $this->isAdmin()
            ? ['manage_users', 'manage_products', 'manage_categories', 'manage_coupons', 'manage_orders', 'restore_products']
            : ['browse_products', 'manage_cart', 'manage_wishlist', 'place_orders'];
    }

    public function hasPermission(string $permission): bool
    {
        return in_array($permission, $this->permissions(), true);
    }

    // Relationships
    public function activityLogs(): HasMany
    {
        return $this->hasMany(ActivityLog::class);
    }

    public function carts(): HasMany
    {
        return $this->hasMany(\App\Models\Cart::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(\App\Models\Order::class);
    }

    public function wishlists(): HasMany
    {
        return $this->hasMany(\App\Models\Wishlist::class);
    }

    public function addresses(): HasMany
    {
        return $this->hasMany(\App\Models\Address::class);
    }

    public function paymentMethods(): HasMany
    {
        return $this->hasMany(\App\Models\PaymentMethod::class);
    }

    public function wishlistProducts(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'wishlists')->withTimestamps();
    }
}
