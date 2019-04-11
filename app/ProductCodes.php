<?php

namespace App;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;

class ProductCodes extends Model
{
    public function merchant()
    {
        return $this->hasOne(Product::class);
    }
}
