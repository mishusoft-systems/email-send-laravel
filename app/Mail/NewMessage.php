<?php

namespace App\Mail;

use App\Models\Message;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewMessage extends Mailable
{
    use Queueable, SerializesModels;

    protected Message $new_message;
    protected User $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $new_message)
    {
        $this->user = $user;
        $this->new_message = $new_message;
    }

    public function getId():int
    {
        return $this->new_message->id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): static
    {

        return $this->markdown('emails.newmessage')
            ->subject($this->new_message->title)
            ->from('wonderful@company.com', 'Wonderful Company')
            ->with([
                'user'=> $this->user,
                'new_message' => $this->new_message,
            ]);
    }
}
