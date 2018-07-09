<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    public function groups() {
    	return $this->hasMany('App\Group');
    }
}
