<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderPlaced extends Mailable
{
    use Queueable, SerializesModels;

    // Necesitamos el usuario y el pedido
    public $user;
    public $order;

    public function __construct($user, $order)
    {
        $this->user = $user;
        $this->order = $order;
    }

    public function build()
    {
        // Devolvemos el email
        return $this->view('Email.OrderPlaced')->subject('¡Pedido realizado exitosamente!');
    }
}
