<?php

namespace App\Models\Messenger;

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
     * Get dialog
     */
    public function messageDialog()
    {
        return $this->belongsTo('App\Models\Messenger\Dialog', 'uid', 'dialog_uid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function messageUser()
    {
        return $this->belongsTo('App\User', 'user_id', 'id')->select('id', 'name', 'avatar');
    }
}
