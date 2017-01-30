<?php

namespace App;
use Illuminate\Foundation\Auth\User as Authenticatable;

class CartLanguage extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id','user_id','total_price','from_language_id','to_language_id','total_words','session_id'];
}
