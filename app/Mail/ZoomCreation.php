<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ZoomCreation extends Mailable
{
    use Queueable, SerializesModels;
    public $date, $id;
    /**
     * Create a new message instance.
     */
    public function __construct($date, $id)
    {
        $this->date = $date;
        $this->id = $id;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Zoom Creation',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'mail.zoom.creation',
            with: [
                'date' => $this->date,
                'id' => $this->id,
                'url_accept' => route('zoom.accept', ['id' => $this->id]),
                'url_reject' => route('zoom.reject', ['id' => $this->id])
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
