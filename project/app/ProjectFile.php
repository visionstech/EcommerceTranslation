<?php

namespace App;
use Illuminate\Foundation\Auth\User as Authenticatable;

class ProjectFile extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id','user_id','order_id','project_id','file_name','file_path','status','translated_file'];
}
