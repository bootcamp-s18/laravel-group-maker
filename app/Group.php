<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    
	public function activity() {
		return $this->belongsTo('App\Activity');
	}

	public function creator() {
		return $this->belongsTo('App\User', 'creator_id');
	}

	public function members() {
		return $this->belongsToMany('App\User');
	}

}
