<?php

namespace App\Models\Messenger;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Dialog extends Model
{
    /**
     * @var string
     */
    protected $table = 'messenger_dialog';

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * Получаем юзера у диалога по user_id = id
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function userDialogFrom()
    {
        return $this->hasOne(User::class, 'id', 'user_id')->select('id','name','avatar','role','email');
    }

}
