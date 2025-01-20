<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ZoomEmailer extends Mailable
{
    use Queueable, SerializesModels;
    public $meeting_id, $topic, $start_time;
    /**
     * Create a new message instance.
     */
    public function __construct($meeting_id, $topic, $start_time)
    {
        $this->meeting_id = $meeting_id;
        $this->topic = $topic;
        $this->start_time = $start_time;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Zoom Emailer',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'mail.zoom.auto-emailer',
            with: [
                'meeting_id' => $this->meeting_id,
                'topic' => $this->topic,
                'start_time' => $this->start_time
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
