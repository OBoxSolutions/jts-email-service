<?php

namespace App\Jobs;

use App\Mail\SendEmailClient;
use App\Mail\SendEmailOwner;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $data;


    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $emailClient = new SendEmailClient($this->data);
        $emailOwner = new SendEmailOwner($this->data);
        Mail::to($this->data['address'])->send($emailClient);
        Mail::to($this->data['owner'])->send($emailOwner);
    }
}
