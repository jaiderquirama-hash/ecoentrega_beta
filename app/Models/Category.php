<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $primaryKey = 'id_category';
    public $timestamps = false;

    protected $fillable = [
        'category_name',
        'description'
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'id_category');
    }
}