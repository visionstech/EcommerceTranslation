<?php

namespace App;
use Illuminate\Foundation\Auth\User as Authenticatable;

class ProjectInstruction extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id','user_id','order_id','tone','instruction','updated_ip','updated_by','status'];
}
