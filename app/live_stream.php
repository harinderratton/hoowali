<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class live_stream extends Model
{
  use SoftDeletes;
  protected $table ='live_stream';
}
