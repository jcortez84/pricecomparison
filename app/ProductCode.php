<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductCode extends Model
{
    public function merchant()
    {
        return $this->hasOne(Product::class);
    }
}
