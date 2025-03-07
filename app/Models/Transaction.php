<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
        //
        protected $fillable = ['user_id', 'product_id', 'quantity', 'total_price', 'status', 'payment', 'transfer_poto'];

        public function user()
        {
            return $this->belongsTo(User::class);
        }
        public function product()
        {
            return $this->belongsTo(Product::class);
        }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($transaction) {
            if (!$transaction->total_price) {
                $product = Product::find($transaction->product_id);
                $transaction->total_price = $product ? $product->price * $transaction->quantity : 0;
            }
        });

        static::updating(function ($transaction) {
            $product = Product::find($transaction->product_id);
            $transaction->total_price = $product ? $product->price * $transaction->quantity : 0;
        });
    }
}
