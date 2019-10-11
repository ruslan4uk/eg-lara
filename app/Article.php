<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    
    use SoftDeletes;

    protected $table = 'articles';

    protected $fillable = ['user_id', 'country_id', 'city_id', 'name', 'text', 'avatar', 'avatar_crop'];

    protected $casts = ['active' => 'Number'];

    /**
     * Relation 
     */
    public function articleCity() {
        return $this->hasOne('App\Geo\City', 'id', 'city_id')->select('id', 'name', 'iso_code')->with('cityCountry');
    }
}
