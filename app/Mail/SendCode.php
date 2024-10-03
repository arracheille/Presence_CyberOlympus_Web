<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;

class SendCode extends Mailable
{
    use Queueable, SerializesModels;

    public $mailMessage;
    public $subject;
    public $workspace;

    /**
     * Create a new message instance.
     */
    public function __construct($mailMessage, $subject, $workspace)
    {
        $this->mailMessage = $mailMessage;
        $this->subject = $subject;
        $this->workspace = $workspace;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('arachelrabbani@gmail.com', 'Presence Workspace'),
            replyTo:[
                new Address('arachelrabbani@gmail.com', 'Presence Workspace')
            ],
            subject: $this->subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mails.code',
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
