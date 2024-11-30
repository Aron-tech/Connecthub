<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword as ResetPasswordNotification;

class CustomPasswordResetNotification extends ResetPasswordNotification
{
    public function toMail($notifiable)
    {
        return (new \Illuminate\Notifications\Messages\MailMessage)
            ->subject('Jelszó visszaállítási értesítés')
            ->line('Ezt az emailt azért kaptad, mert jelszó visszaállítást kértél.')
            ->action('Jelszó visszaállítása', url(route('password.reset', $this->token, false)))
            ->line('Ha nem te kezdeményezted ezt a folyamatot, kérlek, hagyd figyelmen kívül ezt az emailt.');
    }
}
