<?php

namespace App\Models\MessengerOld;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    /**
     * @var string
     */
    protected $table='messenger_messages';

    /**
     * @var array
     */
    protected $guarded=[];

    /**
     * @var array
     */
    protected $appends=['users'];

    /**
     * @var array
     */
    protected $hidden=['is_visible_user', 'is_visible_user_to'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function messageUser()
    {
        return $this->belongsTo('App\User', 'user_id', 'id')->select('id', 'name', 'avatar');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function messageUserTo()
    {
        return $this->belongsTo('App\User', 'user_to_id', 'id')->select('id', 'name', 'avatar');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getUsersAttribute()
    {
        $messageUser = $this->messageUser()->get();
        $messageUserTo = $this->messageUserTo()->get();

        return  $messageUser->merge($messageUserTo);
    }

}
