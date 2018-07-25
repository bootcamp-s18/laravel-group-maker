<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'default_lat', 'default_lon'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function groups_created() {
        return $this->hasMany('App\Group', 'creator_id');
    }


    public function groups_joined() {
        return $this->belongsToMany('App\Group');
    }


    public function distance_from_me($lat, $lon) {

        // If user has default_lat and default_lon
        // then return the distance in miles between
        // the user and the coordinates that are passed in.
        // If not, return undefined

        if ( $this->default_lat && $this->default_lon && $this->coordIsValid($lat) && $this->coordIsValid($lon) ) {

            // do the calculation!

        }
        return NULL; 
    }

    public function coordIsValid($coord) {
        return is_numeric($coord);
    }


}
