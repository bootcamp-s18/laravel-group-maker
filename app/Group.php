<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Group extends Model
{
	use SoftDeletes;
    
	public function activity() {
		return $this->belongsTo('App\Activity');
	}

	public function creator() {
		return $this->belongsTo('App\User', 'creator_id');
	}

	public function members() {
		return $this->belongsToMany('App\User')->withTimestamps();
	}

	/**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

}
