<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $table = 'languages';

    /**
     * Relation table user_language (ManyToMany)
     */
    public function userLanguage() {
        return $this->belongsToMany('App\Language', 'user_language', 'language_id', 'user_id');
    }
}
