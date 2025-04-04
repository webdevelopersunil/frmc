<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserComplainMail extends Mailable
{
    use Queueable, SerializesModels;

    public $complain;
    public $action;
    public $complainant_user;
    public $nodal;
    public $fco;
    public $sendTo;

    /**
     * Create a new message instance.
     */
    public function __construct($complain, $action, $complainant_user, $nodal, $fco, $sendTo)
    {
        $this->complain         =   $complain;
        $this->action           =   $action;
        $this->complainant_user =   $complainant_user;
        $this->nodal            =   $nodal;
        $this->fco              =   $fco;
        $this->sendTo           =   $sendTo;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->markdown('mails.user_complain')
                    ->subject('Acknowledgment of Complaint Lodged – Complaint ID '.$this->complain['complain_no'])
                    ->cc([$this->nodal['email'], $this->fco['email']])    // CC recipient(s)
                    // ->bcc($fco['email']) // BCC recipient(s)
                    ->attach(public_path('assets/Fraud_Prevention_Policy.pdf'))
                    ->with([
                        'complain'          =>  $this->complain,
                        'action'            =>  $this->action,
                        'complainant_user'  =>  $this->complainant_user,
                        'nodal'             =>  $this->nodal,
                        'fco'               =>  $this->fco,
                        'sendTo'            =>  $this->sendTo,
                    ]);
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'mails.user_complain',
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
