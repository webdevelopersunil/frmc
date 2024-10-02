<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\Mail\UserComplainMail;
use Illuminate\Support\Facades\Mail;

class UserEmailJob implements ShouldQueue{

    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $complain_no;
    protected $action;
    protected $user;
    protected $nodal_name;

    /**
     * Create a new job instance.
     */
    public function __construct($complain_no, $action, $user, $nodal_name){

        $this->complain_no      =   $complain_no;
        $this->action           =   $action;
        $this->user             =   $user;
        $this->nodal_name       =   $nodal_name;
    }

    /**
     * Execute the job.
     */
    public function handle(): void{

        try {

            Mail::to($nodal_email)->send(new UserComplainMail($this->complain_no, $this->action, $this->user, $this->nodal_name));
            
        } catch (\Exception $e) {
            // Log the exception
            \Log::error('UserEmailJob failed: ' . $e->getMessage());
            
            // Optionally, rethrow the exception to mark the job as failed
            throw $e;
        }
    }
}
