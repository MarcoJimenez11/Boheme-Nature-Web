<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //

        /*
            Personalización del Email de Verificación enviado al usuario al registrarse
        */
        VerifyEmail::toMailUsing(function (object $notifiable, string $url) {
            return (new MailMessage)
                ->subject('Verificación de Email de Bohême Nature')
                ->greeting('¡Hola!')
                ->line('¡Haz click en el siguiente botón para confirmar el registro de usuario en Bohême Nature!.')
                ->action('Verificar Dirección de correo', $url)
                ->line('Si no has solicitado ningún registro, puedes ignorar este correo.')
                ->salutation('¡Gracias por confiar en Bohême Nature!');
        });
    }
}
