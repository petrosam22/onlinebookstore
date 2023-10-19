<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;

class SendOrderMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */

     public $number;
     public $book;
     public $total;
     public $user;
     public $quantities;
    public function __construct($number,$book,$total,$quantities,$user)
    {
        $this->number = $number;
        $this->book = $book;
        $this->total = $total;
        $this->quantities = $quantities;
        $this->user = $user;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('petrosam26@gmail.com','peter'),
            subject: 'Order Created',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.sendOrder',
            with:[
                'number'=>   $this->number,
                'book'=>   $this->book,
                'total'=>   $this->total,
                'quantities'=>   $this->quantities,
                'user'=>   $this->user,

            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
