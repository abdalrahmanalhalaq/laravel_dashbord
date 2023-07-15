<?php

namespace App\Mail;

use App\Models\Admin;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AdminWelcomeEmail extends Mailable // تتبع لها واجهات الايميل
{
    use Queueable, SerializesModels;

    public Admin $admin;
    public $password;
    /**
     * Create a new message instance.
     *
     * @return void
     */



    public function __construct(Admin $admin )  //  (Admin $admin) يعني هو بكل بساطة راح جاب هاد ومرر قيمته للببلك عشان تصير القيمة عامة
    {
            //
            $this->admin =  $admin;  // this اشارة مرجعية تعود على  الكلاس كله
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Admin Welcome Email',
            from:'abd@gmail.com',
           to: $this->admin->email,
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
            markdown: 'emails.admin_welcome_email', // انا باصيت قيم جدول الادمن من خلال الببلك .. فيهك انا بقدر بالواجهة تعت الميل استدعي المتغيرات
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
