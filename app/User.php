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
        'password', 'remember_token',
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
    
}
