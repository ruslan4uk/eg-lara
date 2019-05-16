<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject 
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'about'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'id' => 'Number',
    ];

    
    
     /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier() {
        return $this->getKey(); // Eloquent Model method
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims() {
        return [];
    }

    /**
     * Relation table tour
     */
    public function tour() {
        return $this->hasMany('App\Tour', 'user_id', 'id');
    }

    /**
     * Relation table user_contacts
     */
    public function userContact() {
        return $this->hasMany('App\UserContact', 'user_id', 'id');
    }

    /**
     * Relation table user_license
     */
    public function userLicense() {
        return $this->hasMany('App\UserLicense', 'user_id', 'id');
    }

    /**
     * Relation table user_service (ManyToMany)
     */
    public function userService() {
        return $this->belongsToMany('App\Service', 'user_service', 'user_id', 'service_id');
    }

    /**
     * Relation table user_language (ManyToMany)
     */
    public function userLanguage() {
        return $this->belongsToMany('App\Language', 'user_language', 'user_id', 'language_id');
    }

    /**
     * Relation table country (ManyToMany)
     */
    public function userCountry() {
        return $this->belongsToMany('App\Geo\Country', 'user_country', 'user_id', 'country_id');
    }

    /**
     * Relation table city (ManyToMany)
     */
    public function userCity() {
        return $this->belongsToMany('App\Geo\City', 'user_city', 'user_id', 'city_id')
                    ->select('city.id', 'city.name', 'city.iso_code', 'city.city_country');
    }
    
}
