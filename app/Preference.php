<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Preference extends Model
{
    private $fillables = ['user_id', 'phone', 'newsletters', 'alerts'];
}
