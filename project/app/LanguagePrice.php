<?php

namespace App;
use Illuminate\Foundation\Auth\User as Authenticatable;

class LanguagePrice extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id','source','destination','price_per_word','updated_by','updated_ip'];
    public $filterable = [
        'source','destination'
    ];
    
    public function source()
	{
	    return $this->belongsTo('App\Language','source');
	}


	public function destination()
	{
	    return $this->belongsTo('App\Language','destination');
	}


}
