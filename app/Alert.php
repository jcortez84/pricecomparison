<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alert extends Model
{
    protected $fillable = ['product_id', 'target_price','email'];

    public function product()
    {
       return $this->hasOne(Product::class);
    }

    public function user()
    {
       return $this->hasOne(User::class);
    }
}
