<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;

    protected $table = 'comments';

    protected $fillable = ['active', 'text', 'user_id', 'page_id'];

    /**
     * Relation users (Author)
     */
    public function commentAuthor() {
        return $this->hasOne('App\User', 'id', 'user_id')->select('id', 'name','avatar');
    }

    /**
     * Relation users (From -> Guide)
     */
    public function commentGuide() {
        return $this->hasOne('App\User', 'id', 'page_id');
    }

}
