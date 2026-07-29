<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RequestDetail extends Model
{
    protected $table = 'request_details';
    protected $primaryKey = 'id_request_detail';
    public $timestamps = false;

    protected $fillable = ['id_request', 'id_product', 'quantity', 'message'];

    public function request()
    {
        return $this->belongsTo(Request::class, 'id_request');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'id_product');
    }
}
