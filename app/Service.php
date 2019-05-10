<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = 'services';

    /**
     * Relation table users (ManyToMany)
     */
    public function serviceUser() {
        return $this->belongsToMany('App\User', 'user_service', 'service_id', 'user_id');
    }
}
