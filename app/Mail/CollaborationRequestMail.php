<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CollaborationRequestMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public string $senderName,
        public string $senderEmail,
        public string $senderPhone,
        public string $collabType,
        public string $collabMessage,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '[HMTI Margonda] Pengajuan Kolaborasi Baru dari ' . $this->senderName,
            replyTo: [$this->senderEmail],
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'mail.collaboration-request',
        );
    }
}
