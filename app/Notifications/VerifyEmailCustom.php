<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail as BaseVerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\HtmlString;

class VerifyEmailCustom extends BaseVerifyEmail
{
    public function toMail($notifiable)
    {
        $verificationUrl = $this->verificationUrl($notifiable);

        return (new MailMessage)
            ->subject('Verifikasi Email Anda - Haromain Travel')
            ->greeting('Assalamu’alaikum!')
            ->line('Terima kasih telah mendaftar di Haromain Travel.')
            ->line('Klik tombol di bawah ini untuk memverifikasi alamat email Anda:')
            ->action('Verifikasi Email', $verificationUrl)
            ->line('Setelah verifikasi, Anda dapat mulai merencanakan perjalanan umrah atau haji bersama kami.')
            ->line('Jika Anda tidak membuat akun ini, abaikan email ini.')
            ->salutation(new HtmlString("Wassalamu’alaikum,<br><strong>Tim Haromain Travel</strong>"));
    }

    protected function verificationUrl($notifiable)
    {
        return URL::temporarySignedRoute(
            'verification.verify',
            Carbon::now()->addMinutes(60),
            [
                'id' => $notifiable->getKey(),
                'hash' => sha1($notifiable->getEmailForVerification()),
            ]
        );
    }
}
