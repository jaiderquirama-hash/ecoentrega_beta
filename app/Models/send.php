<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Send extends Model
{
    protected $table = 'sends';
    protected $primaryKey = 'id_send';
    public $timestamps = false;

    protected $fillable = [
        'id_user',
        'id_request',
        'send_status',
        'notes',
        'send_date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function request()
    {
        return $this->belongsTo(Request::class, 'id_request');
    }
}