<?php

namespace App;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Order extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id','transaction_id','user_id','payment_status','payment_type'];
}
