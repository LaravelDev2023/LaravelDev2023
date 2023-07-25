<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendForgatePasswordEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $emailData;

    /** 
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($emailData)
    {
        //
       // echo"<pre>"; print_r($emailData); exit;
        $this->emailData = $emailData;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Welcome Email',
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
            view: 'text_mail',
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
    public function build()
    {   
        // $data = $this->emailData;
        // echo"<pre>"; print_r($data); exit;
        return $this
            ->from('developelaravelsoft@gmail.com', 'AliGroup')
            ->replyTo('reply_to_mail@mail.com', 'Reply To Email')
            ->subject('My Store- Reset Password Request')
            ->view('forgate_pasword_email')
            ->with([
                'token' => $this->emailData['token'],
                'email' => $this->emailData['email'],
            ]);    
    }
}
