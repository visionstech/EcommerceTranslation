<?php

namespace App;
use Illuminate\Foundation\Auth\User as Authenticatable;

class CartItem extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id','user_id','content','file','file_path','content_words','file_words','total_words','user_ip'];
}
