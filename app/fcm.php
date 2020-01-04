<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class fcm extends Model
{
    use SoftDeletes;    
    protected $table='fcm';
}
