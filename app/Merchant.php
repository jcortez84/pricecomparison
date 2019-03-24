<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Merchant extends Model
{
    protected $primaryKey = 'id';
    public $incrementing = false;

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
