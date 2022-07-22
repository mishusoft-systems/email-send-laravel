<?php

namespace App\Jobs;

use App\Models\SentEmail;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    protected string $email;
    protected Mailable $emailClass;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($email, $emailClass)
    {
        $this->email = $email;
        $this->emailClass = $emailClass;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(): void
    {
        // Update user hash
        $user = User::where('email', $this->email);

        if (User::where('hash', md5($user->get()->first()->id))->get() === []) {
            $user->update(['hash' => md5($user->get()->first()->id)]);
        }

        SentEmail::create(array(
            'user' => $user->get()->first()->id,
            'message' => $this->emailClass->getId()
        ));

        Mail::to($this->email)->send($this->emailClass);
    }
}
