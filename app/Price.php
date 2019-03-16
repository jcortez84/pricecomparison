<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function images()
    {
       return $this->hasMany(ProductImage::class, 'product_id');
    }
}
