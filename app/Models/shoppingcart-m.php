<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShoppingCart extends Model
{
    protected $table = 'shopping_carts';
    protected $primaryKey = 'id_cart';
    public $timestamps = false;

    protected $fillable = [
        'creation_date',
        'id_user'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function cartDetails()
    {
        return $this->hasMany(CartDetail::class, 'id_cart');
    }
}