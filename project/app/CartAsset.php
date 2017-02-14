<?php

namespace App;
use Illuminate\Foundation\Auth\User as Authenticatable;

class CartAsset extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id','user_id','session_id','status','asset_type','file_name','file_path'];
}
