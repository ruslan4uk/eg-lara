<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    protected $table = "tours";

    protected $fillable = ['user_id'];

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
        return $this->hasMany('App\PeopleCategory', 'people_category_id', 'id');
    }

    /**
     * Relation table timing
     */
    public function tourTiming() {
        return $this->hasMany('App\Timing', 'timing_id', 'id');
    }

     /**
     * Relation table currency
     */
    public function tourCurrency() {
        return $this->hasMany('App\Currency', 'currency_id', 'id');
    }

    /**
     * Relation table tourPriceType
     */
    public function tourPriceType() {
        return $this->hasMany('App\PriceType', 'price_type_id', 'id');
    }

    /**
     * Relation table tour_images
     */
    public function tourImage() {
        return $this->hasMany('App\TourImage', 'tour_id', 'id');
    }

}
