<?php

namespace App\Models\MessengerOld;

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


}
