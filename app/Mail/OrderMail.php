<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Support\Str;


class OrderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $cart;
    public $order;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($cart, $order)
    {
        $this->cart = $cart;
        $this->order = $order;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Order Mail',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            markdown: 'emails.order',
            with: [
                'cart' => $this->cart,
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return \Illuminate\Mail\Mailables\Attachment[]
     */
    public function attachments()
    {
        $slug = Str::slug($this->order->created_at, '-');
        $fileName = 'invoice_' .$slug. '.pdf';
        return [
            //Attachment::fromPath('storage/app/public/invoices'),
            
            storage_path('app/public/invoices/'.$fileName)
        ];
    }
}
