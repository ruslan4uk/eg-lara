<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserLicense extends Model
{
    protected $table = 'user_license';

    protected $fillable = ['user_id', 'image', 'image_crop'];

    /**
     * Relation table user_license (revers)
     */
    public function user() {
        $this->belongsTo('App\User', 'user_id', 'id');
    }
}
