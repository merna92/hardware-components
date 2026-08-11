<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Order;


#[Fillable(['first_name', 'last_name', 'name', 'email', 'phone_number', 'role_type', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'first_name',
        'last_name',
        'name',
        'email',
        'phone_number',
        'role_type',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function carts(): HasMany
    {
        return $this->hasMany(\App\Models\Cart::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(\App\Models\Order::class);
    }

    /**
     * الحقول المسموح بكتابتها في قاعدة البيانات
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'name',
        'email',
        'phone',
        'password',
        'role',
        'avatar',
    ];

    /**
     * الحقول المخفية عند تحويل الموديل لـ Array أو JSON
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'last_login' => 'datetime',
            'password' => 'hashed',
        ];
    }
                public function orders()
        {
            return $this->hasMany(\App\Models\Order::class);
        }

        public function wishlists()
{
    return $this->hasMany(\App\Models\Wishlist::class);
}
public function addresses()
{
    return $this->hasMany(\App\Models\Address::class);
}
public function paymentMethods()
{
    return $this->hasMany(\App\Models\PaymentMethod::class);
}

}