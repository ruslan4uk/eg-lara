<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserContact extends Model
{
    protected $table = 'user_contacts';

    protected $fillable = ['type', 'text'];

    protected $casts = [
        'user_id' => 'Number',
        'type' => 'Number',
    ];

    /**
     * Relation table user (revers)
     */
    public function user() {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    /**
     * Relation table contact_type
     */
    public function contactType() {
        return $this->hasMany('App\ContactType', 'id', 'type');
    }
}
