<?php

namespace App;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function prices()
    {
       return $this->hasMany(Price::class);
    }

    public function merchant()
    {
        return $this->hasOne(Merchant::class);
    }

    public function images()
    {
       return $this->hasOne(ProductImage::class);
    }
    
    public function product_codes()
    {
       return $this->hasMany(ProductCode::class);
    }

}
