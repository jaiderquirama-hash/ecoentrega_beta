<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartDetail extends Model
{
    protected $table = 'cart_details';
    protected $primaryKey = 'id_cart_detail';
    public $timestamps = false;

    protected $fillable = ['quantity', 'subtotal', 'id_cart', 'id_product'];

    public function shoppingCart()
    {
        return $this->belongsTo(ShoppingCart::class, 'id_cart');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'id_product');
    }
}
