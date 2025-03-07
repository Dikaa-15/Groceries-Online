<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $fillable = [
        'name',
        'stock',
        'price',
        'category',
        'description',
        'image'
    ];
    
    protected $casts = [
        'category' => 'array',
    ];

    
    public function carts()
    {
        return $this->hasMany(Carts::class);
    }
    public function rates()
    {
        return $this->hasMany(Rates::class);
    }
}
