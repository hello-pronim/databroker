<?php
namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPasswordNotification extends ResetPassword
{
    public $token;
    protected $firstname;

    public function __construct($token, $firstname)
    {
        $this->token = $token;
        $this->firstname = $firstname;
    }
    /**
     * Build the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        if (static::$toMailCallback) {
            return call_user_func(static::$toMailCallback, $notifiable, $this->token, $this->firstname);
        }

        return (new MailMessage)
            ->view(
                'email.password', [
                    'token' => $this->token,
                    'firstname'=>$this->firstname
                ]
            )
            ->subject('Need to reset your password?');
    }
}
?>