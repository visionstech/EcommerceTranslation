<?php

namespace App;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Company extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id','user_id','company','address','session_id'];
}
