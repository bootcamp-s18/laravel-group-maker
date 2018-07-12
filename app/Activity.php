<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Activity extends Model
{
    public function groups() {
    	return $this->hasMany('App\Group');
    }

    public function participants() {

    	$results = DB::select('SELECT count(*) FROM group_user
WHERE group_id IN (SELECT id FROM groups WHERE activity_id = ?)', [$this->id]);

    	return $results[0]->count;

    }

    public function test() {
        return $this->hasManyThrough('App\User', 'App\Group');
    }

}
