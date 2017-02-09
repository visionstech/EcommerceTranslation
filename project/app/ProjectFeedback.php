<?php

namespace App;
use Illuminate\Foundation\Auth\User as Authenticatable;

class ProjectFeedback extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id','project_id','file_id','corrections','comment','feedback_file','status'];
}
