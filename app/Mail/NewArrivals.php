<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewArrivals extends Mailable
{
    use Queueable, SerializesModels;

    protected $new_arrival;
    protected $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $new_arrival)
    {
        $this->user = $user;
        $this->new_arrival = $new_arrival;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): static
    {

        return $this->markdown('emails.newarrivals')
            ->subject($this->new_arrival->title)
            ->from('wonderful@company.com', 'Wonderful Company')
            ->with([
                'user'=> $this->user,
                'new_arrival' => $this->new_arrival,
            ]);
    }
}
