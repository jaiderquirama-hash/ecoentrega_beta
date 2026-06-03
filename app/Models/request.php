<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    protected $table = 'requests';
    protected $primaryKey = 'id_request';
    public $timestamps = false;

    protected $fillable = [
        'title',
        'description',
        'size',
        'color',
        'max_price',
        'status',
        'request_date',
        'id_user'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function requestDetails()
    {
        return $this->hasMany(RequestDetail::class, 'id_request');
    }

    public function sends()
    {
        return $this->hasMany(Send::class, 'id_request');
    }
}