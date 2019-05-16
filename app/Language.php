<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $table = 'languages';

    /**
     * Relation table user_language (ManyToMany)
     */
    public function languageUser() {
        return $this->belongsToMany('App\User', 'user_language', 'language_id', 'user_id');
    }

    /**
     * Relation table user_language (ManyToMany)
     */
    public function languageTour() {
        return $this->belongsToMany('App\Tour', 'user_language', 'language_id', 'user_id');
    }
}
