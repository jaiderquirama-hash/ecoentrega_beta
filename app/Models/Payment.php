<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payments';
    protected $primaryKey = 'id_payment';
    public $timestamps = false;

    protected $fillable = [
        'payment_method',
        'payment_status',
        'payment_date',
        'amount'
    ];

    public function order()
    {
        return $this->hasOne(Order::class, 'id_payment');
    }
}
