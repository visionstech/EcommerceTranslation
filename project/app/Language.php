<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Language extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id','name','short'];
}
