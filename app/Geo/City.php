<?php

namespace App\Geo;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table="city";

    /**
     * Relation table user (ManyToMany)
     */
    public function cityUser() {
        return $this->belongsToMany('App\User', 'user_city', 'city_id', 'user_id');
    }

    /**
     * Relation table country (HasMany) revers
     */
    public function cityCountry() {
        return $this->belongsTo('App\Geo\Country', 'iso_code', 'iso_code')->select('id', 'name', 'iso_code');
    }
}
