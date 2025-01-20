<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CaseEmailer extends Mailable
{
    use Queueable, SerializesModels;
    public $date, $nps_docket_no, $case_stage;
    /**
     * Create a new message instance.
     */
    public function __construct($date, $nps_docket_no, $case_stage)
    {
        $this->nps_docket_no = $nps_docket_no;
        $this->date = $date;
        $this->case_stage = $case_stage;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Case Emailer',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'mail.emailer.case-emailer',
            with: [
                'date' => $this->date,
                'nps_docket_no' => $this->nps_docket_no,
                'case_stage' => $this->case_stage
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
