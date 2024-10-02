<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class FcoComplainMail extends Mailable
{
    use Queueable, SerializesModels;

    public $complain;
    public $action;
    public $complainant_user;
    public $nodal;
    public $sendTo;

    /**
     * Create a new message instance.
     */
    public function __construct($complain, $action, $complainant_user, $nodal, $sendTo)
    {
        $this->complain         =   $complain;
        $this->action           =   $action;
        $this->complainant_user =   $complainant_user;
        $this->nodal            =   $nodal;
        $this->sendTo           =   $sendTo;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->markdown('mails.user_complain')
                    ->subject('Complain Updated')
                    ->with([
                        'complain'          =>  $this->complain,
                        'action'            =>  $this->action,
                        'complainant_user'  =>  $this->complainant_user,
                        'nodal'             =>  $this->nodal,
                        'sendTo'            =>  $this->sendTo,
                    ]);
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'mails.fco_complain',
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
