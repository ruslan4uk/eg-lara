<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserLicense extends Model
{
    protected $table = 'user_license';

    /**
     * Relation table user_license (revers)
     */
    public function user() {
        $this->belongsTo('App\User', 'user_id', 'id');
    }
}
