<?php

namespace App\Models\Messenger;

use Illuminate\Database\Eloquent\Model;

class Dialog extends Model
{
    /**
     * @var string
     */
    protected $table='messenger_dialog';

    /**
     * @var array
     */
    protected $guarded=[];

    /**
     * Get messages in one dialog
     */
    public function dialogMessages()
    {
        return $this->hasMany('App\Models\Messenger\Message', 'dialog_uid', 'uid')->latest();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function dialogUsers()
    {
        return $this->belongsToMany('App\User', 'user_messenger_dialog', 'dialog_uid', 'user_id', 'uid', 'id');
    }

}
