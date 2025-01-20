<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ZoomMeetingEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $meeting_url, $date;
    /**
     * Create a new message instance.
     */
    public function __construct($meeting_url, $date)
    {
        $this->meeting_url = $meeting_url;
        $this->date = $date;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Zoom Meeting Email',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'mail.zoom.meeting',
            with: [
                'meeting_url' => $this->meeting_url,
                'date' => $this->date
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
