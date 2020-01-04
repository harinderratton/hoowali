<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class free_events extends Model
{
    use SoftDeletes;    
  protected $table='free_events';
}
