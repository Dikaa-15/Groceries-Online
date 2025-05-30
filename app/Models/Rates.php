<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rates extends Model
{
    //   
    protected $fillable = ['user_id', 'product_id', 'rate', 'comment'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function averageRating()
    {
        return $this->rates()->avg('rate');
    }
}
