<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'about', 'role'
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
        'user_service' => 'Array',
        'email_verified_at' => 'datetime',
        'id' => 'Number',
    ];

    /**
     * Enable soft delete
     *
     * @var bool
     */
    protected $softDelete = true;

//    protected $appends = ['unreadMessage'];

    /**
     * Return has admin
     *
     * @return boolean
     */
    public function isAdmin()
    {
        return $this->status === 999 ? true : false;
    }


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
     * User table user_contact -> contact_type
     */
    public function userContactType() {
        return $this->userContact()->with('contactType');
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

    /**
     * Related comments
     */
    public function userComment() {
        return $this->belongsToMany('App\User', 'comments', 'page_id', 'user_id')
                    ->withPivot('text')
                    ->whereNull('comments.deleted_at')
                    ->where('comments.active', 2)
                    ->orderBy('comments.created_at', 'desc')
                    ->withTimestamps();
    }

    /**
     * Relation table favorite user (ManyToMany)
     */
    public function userFavoriteGuide() {
        return $this->belongsToMany('App\User', 'user_favorite_guide', 'user_id', 'guide_id')
                    ->withCount(['tour' => function($q) {
                        $q->where('active', 2);
                    }])
                    ->withTimestamps();
    }

    /**
     * Relation table favorite tour (ManyToMany)
     */
    public function userFavoriteTour() {
        return $this->belongsToMany('App\Tour', 'user_favorite_tour', 'user_id', 'tour_id')
                    ->withTimestamps();
    }

    /**
     * Get user dialogs
     */
    public function userDialogs()
    {
        return $this->hasMany(\App\Models\Messenger\Dialog::class, 'user_id', 'id');
    }

    public function unreadMessage()
    {
        return $this->hasMany(\App\Models\Messenger\Message::class, 'user_to_id', 'id')->where('is_read', 0)->count();
    }

}
