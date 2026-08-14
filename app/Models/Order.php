<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $primaryKey = 'id_order';
    public $timestamps = false;

    protected $fillable = ['id_user', 'id_client', 'id_payment', 'total', 'order_status', 'order_date'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class, 'id_payment');
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'id_client');
    }

    public function details()
    {
        return $this->hasMany(OrderDetail::class, 'id_order');
    }
}
