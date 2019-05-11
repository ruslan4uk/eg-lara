<?php

namespace App\Geo;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table="country";

    /**
     * Relation table user (ManyToMany)
     */
    public function countryUser() {
        return $this->belongsToMany('App\User', 'user_city', 'country_id', 'user_id');
    }

    /**
     * Relation table city (HasMany)
     */
    public function coutryCity () {
        return $this->hasMany('App\Geo\City', 'iso_code', 'iso_code');
    }
}
