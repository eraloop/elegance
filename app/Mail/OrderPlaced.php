<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderPlaced extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $isAdminCopy;

    public function __construct(Order $order, $isAdminCopy = false)
    {
        $this->order = $order;
        $this->isAdminCopy = $isAdminCopy;
    }

    public function envelope(): Envelope
    {
        $subject = $this->isAdminCopy
            ? 'New Order Received: ' . $this->order->order_number
            : 'Order Confirmation: ' . $this->order->order_number;

        return new Envelope(
            subject: $subject,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.order-placed',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
