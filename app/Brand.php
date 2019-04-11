<?php

namespace App;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    public function product()
    {
       return $this->hasOne(Product::class);
    }
}
