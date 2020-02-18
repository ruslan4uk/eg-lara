<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AuthConfirm extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var
     */
    protected $user;

    /**
     * @var
     */
    protected $hash;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
//        $this->user->hash = md5($user->email . $user->created_at);
        $this->hash = md5($user->email . $user->created_at);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.confirm')
                    ->subject('Спасибо за регистрацию')
                    ->with([
                        'name'  => $this->user->name,
                        'hash'  => $this->hash,
                        'email' => $this->user->email
                    ]);
    }
}
