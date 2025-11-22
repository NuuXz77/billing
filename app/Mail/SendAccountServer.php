<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendAccountServer extends Mailable
{
    use Queueable, SerializesModels;

    public $transaction;
    public $serverUsername;
    public $serverPassword;
    public $additionalMessage;
    public $adminNotes;

    /**
     * Create a new message instance.
     */
    public function __construct($transaction, $serverUsername, $serverPassword, $additionalMessage = null, $adminNotes = null)
    {
        $this->transaction = $transaction;
        $this->serverUsername = $serverUsername;
        $this->serverPassword = $serverPassword;
        $this->additionalMessage = $additionalMessage;
        $this->adminNotes = $adminNotes;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Akun Server Anda - ' . $this->transaction->transaction_code,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.send-account-server',
            with: [
                'transaction' => $this->transaction,
                'serverUsername' => $this->serverUsername,
                'serverPassword' => $this->serverPassword,
                'additionalMessage' => $this->additionalMessage,
                'adminNotes' => $this->adminNotes,
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
