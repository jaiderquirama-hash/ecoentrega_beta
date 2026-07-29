<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    public function products()
    {
        return $this->hasMany(Product::class, 'id_user');
    }

    public function requests()
    {
        return $this->hasMany(Request::class, 'id_user');
    }

    public function shoppingCart()
    {
        return $this->hasOne(ShoppingCart::class, 'id_user');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'id_user');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'id_user');
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
