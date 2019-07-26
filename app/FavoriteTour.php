<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FavoriteTour extends Model
{
    protected $table = 'user_favorite_tour';

    protected $fillable = [
        'user_id', 'tour_id'
    ];

}
