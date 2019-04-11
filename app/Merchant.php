<?php

namespace App;

use Laravel\Scout\Searchable;
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
