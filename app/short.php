<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class short extends Model
{
    use SoftDeletes;    
    protected $table='short';   
}
