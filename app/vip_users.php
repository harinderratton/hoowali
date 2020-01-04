<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class vip_users extends Model
{
    use SoftDeletes;    
    protected $table='vip_users';
}
