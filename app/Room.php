<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $table="phong";
    protected $fillable=['name','description','status'];
}
