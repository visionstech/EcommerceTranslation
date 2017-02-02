<?php

namespace App;
use Illuminate\Foundation\Auth\User as Authenticatable;

class ProjectBrief extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id','user_id','order_id','file_name','file_path'];
}
