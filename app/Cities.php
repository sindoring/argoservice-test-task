<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cities extends Model
{
    protected $fillable = ['name','latitude', 'longitude','population'];
    protected $hidden = ['created_at','updated_at'];
}
