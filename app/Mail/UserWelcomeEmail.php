<?php

namespace App\Mail;

use App\Models\Admin;
use App\Models\order;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class UserWelcomeEmail extends Mailable
{
    use Queueable, SerializesModels;

    public order $order;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(order $order)
    {
        //
        $this->order =  $order; // this اشارة مرجعية تعود على  الكلاس كله
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'User Welcome ',
            from: 'aboodSuport@gmail.com',
            to:  $this->order->student_email,

        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            markdown: 'emails.user_welcome_email',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
