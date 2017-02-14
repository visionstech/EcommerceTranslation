<?php

namespace App;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Project extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id','user_id','order_id','from_lang_id','to_lang_id','language_price','total_price','package_price','final_price','language_package','translation_purpose','status','assigned_translator'];
}
