<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;

use Spatie\Permission\Traits\HasRoles;

#[Fillable(['name', 'email', 'password', 'role'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable implements FilamentUser
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->hasRole('super_admin');
    }

    public function isSuperAdmin(): bool
    {
        return $this->hasRole('super_admin');
    }

    public function isCliente(): bool
    {
        return $this->hasRole('cliente');
    }

    protected static function booted(): void
    {
        static::created(function (User $user) {
            if (! $user->roles()->exists()) {
                $user->assignRole('cliente');
            }
        });
    }

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

    public function client()
    {
        return $this->hasOne(Client::class, 'id_user');
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
