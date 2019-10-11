<?php

namespace App\Models\Messenger;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    /**
     * @var string
     */
    protected $table = 'messenger_messages';

    /**
     * @var array
     */
    protected $guarded = [];

    protected $casts = ['attach' => 'Object'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function userMessageFrom()
    {
        return $this->hasOne(User::class, 'id', 'user_id')->select('id','name','avatar','role','email');
    }
}
