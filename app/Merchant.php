<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Merchant extends Model
{
    protected $primaryKey = 'mId';
    public $incrementing = false;

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
