<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AppointmentCreationClient extends Mailable
{
    use Queueable, SerializesModels;
    public $requirements, $time, $date, $id;
    /**
     * Create a new message instance.
     */
    public function __construct($requirements, $time, $date, $id)
    {
        $this->requirements = $requirements;
        $this->time = $time;
        $this->date = $date;
        $this->id = $id;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Appointment Creation Client',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'mail.appointment.client-creation',
            with: [
                'requirements' => $this->requirements,
                'date' => $this->date,
                'time' => $this->time,
                'id' => $this->id
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
