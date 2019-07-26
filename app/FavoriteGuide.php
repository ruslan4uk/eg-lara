<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FavoriteGuide extends Model
{
    protected $table = 'user_favorite_guide';

    protected $fillable = [
        'user_id', 'guide_id'
    ];
}
