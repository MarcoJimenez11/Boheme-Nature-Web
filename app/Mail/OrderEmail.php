<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

/**
 * Modelo de email de confirmación de pedido
 */
class OrderEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Crea una nueva instancia de mensaje
     */
    public function __construct(private $order, private $orderLines)
    {
        //
    }

    /**
     * Devuelve el asunto del mensaje
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Tu pedido en Bohême Nature se ha realizado con éxito',
        );
    }

    /**
     * Devuelve el contenido del mensaje
     */
    public function content(): Content
    {
        return new Content(
            view: 'auth.order-email',
            with: [
                'order' => $this->order,
                'orderLines' => $this->orderLines,
            ],
        );
    }

    /**
     * Devuelve los adjuntos del mensaje
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
