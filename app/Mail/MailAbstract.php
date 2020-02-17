<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailAbstract extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var
     */
    protected $user_id;

    /**
     * @var
     */
    protected $user_name;

    /**
     * @var
     */
    protected $mail_view;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user_id, $user_name, $mail_view)
    {
        $this->user_id = $user_id;
        $this->user_name = $user_name;
        $this->mail_view = $mail_view;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view($this->mail_view)
            ->subject('Информация от Excursguide')
            ->with([
            'name' => $this->user_name,
        ]);
    }
}
