<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ClientActivation extends Mailable
{
    use Queueable, SerializesModels;

    public $client;
    public $activationToken;

    /**
     * Create a new message instance.
     *
     * @param $client
     * @param $activationToken
     */

    public function __construct($client, $activationToken)
    {
        $this->client = $client;
        $this->activationToken = $activationToken;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Account Activation',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'mail.account.activation',
            with: [
                'client' => $this->client,
                'activationToken' => $this->activationToken,
                'url' => route('activate-account', ['token' => $this->activationToken])
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
