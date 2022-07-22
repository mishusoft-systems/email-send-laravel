<?php

namespace App\Mail;

use App\Models\Event;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewEvent extends Mailable
{
    use Queueable, SerializesModels;

    protected Event $new_event;
    protected User $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $new_event)
    {
        $this->user = $user;
        $this->new_event = $new_event;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): static
    {

        return $this->markdown('emails.newevent')
            ->subject($this->new_event->title)
            ->from('wonderful@company.com', 'Wonderful Company')
            ->with([
                'user'=> $this->user,
                'new_event' => $this->new_event,
            ]);
    }
}
