<?php

namespace App\Mail\Student;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Attachment;
use App\Models\Application;

class ApplyToInternship extends Mailable
{
    use Queueable, SerializesModels;

    private $application;

    /**
     * Create a new message instance.
     */
    public function __construct($applicationId)
    {
        $this->application = Application::find($applicationId);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('no-reply@linkif.com', 'Linkif'),
            subject: "Novo candidato para a vaga {$this->application->internship->title}",
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'student.mail.apply-to-internship',
            with: [
                'application' => $this->application,
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
        $pdf = $this->application->student->resume->toPdf();

        return [
            Attachment::fromPath($pdf)
                ->as('cv.pdf')
                ->withMime('application/pdf'),
        ];
    }
}
