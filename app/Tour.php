<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    protected $table = "tours";

    protected $fillable = ['user_id', 'name', 'city_id', 'tour_route', 'category_id', 'people_category_id',
                            'people_count', 'timing_id', 'price', 'currency_id', 'price_type_id',
                            'tour_services', 'tour_more', 'tour_other', 'about', 'active'];

    /**
     * Relation table user (revers)
     */
    public function user() {
        return $this->belongsToMany('App\User', 'user_id', 'id');
    }

    /**
     * Relation table user_language (ManyToMany)
     */
    public function tourLanguage() {
        return $this->belongsToMany('App\Language', 'tour_language', 'tour_id', 'language_id');
    }

    /**
     * Relation table category
     */
    public function tourCategory() {
        return $this->hasMany('App\Category', 'id', 'category_id');
    }

    /**
     * Relation table peopleCategory
     */
    public function tourPeopleCategory() {
        return $this->hasMany('App\PeopleCategory', 'id', 'people_category_id');
    }

    /**
     * Relation table timing
     */
    public function tourTiming() {
        return $this->hasMany('App\Timing', 'id', 'timing_id');
    }

     /**
     * Relation table currency
     */
    public function tourCurrency() {
        return $this->hasMany('App\Currency', 'id', 'currency_id');
    }

    /**
     * Relation table tourPriceType
     */
    public function tourPriceType() {
        return $this->hasMany('App\PriceType', 'id', 'price_type_id');
    }

    /**
     * Relation table tour_images
     */
    public function tourImage() {
        return $this->hasMany('App\TourImage', 'tour_id', 'id');
    }

    /**
     * Relation table city
     */
    public function tourCity() {
        return $this->hasMany('App\Geo\City', 'id', 'city_id')->select('id', 'name', 'iso_code')->with('cityCountry');
    }

}
